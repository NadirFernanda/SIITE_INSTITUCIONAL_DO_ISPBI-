<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Concurso;
use App\Models\ConcursoAlert;
use App\Models\ConcursoAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConcursoPublished;

class ConcursoController extends Controller
{
    public function index()
    {
        $concursos = Concurso::orderByDesc('publish_at')->paginate(20);
        return view('admin.concursos.index', compact('concursos'));
    }

    public function create()
    {
        return view('admin.concursos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'publish_at' => 'nullable|date',
            'attachments.*' => 'file|mimes:pdf,doc,docx|max:10240',
        ]);

        $concurso = Concurso::create($data + ['created_by' => auth()->id()]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                // store on the public disk so files are served from /storage
                $path = $file->store('concursos', 'public');
                $concurso->attachments()->create([
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        // If published on create, notify
        if ($concurso->status === 'published') {
            try {
                // queue email to avoid blocking request; requires a queue worker (QUEUE_CONNECTION not 'sync')
                Mail::to(['dpto.rhas@isp-bie.ao','geral@isp-bie.ao'])->queue(new ConcursoPublished($concurso));
                // also notify subscribed users who gave consent, in batches to avoid memory issues
                $this->queueConcursoAlertsToSubscribers($concurso);
            } catch (\Throwable $e) {
                // fallback to synchronous send if queueing fails
                try {
                    Mail::to(['dpto.rhas@isp-bie.ao','geral@isp-bie.ao'])->send(new ConcursoPublished($concurso));
                    $this->sendConcursoAlertsToSubscribersSync($concurso);
                } catch (\Throwable $e2) {
                    \Log::error('Falha ao enviar email de concurso publicado: '.$e2->getMessage());
                }
            }
        }

        return redirect()->route('admin.concursos.index')->with('status', 'Concurso criado.');
    }

    public function edit(Concurso $concurso)
    {
        return view('admin.concursos.edit', compact('concurso'));
    }

    public function update(Request $request, Concurso $concurso)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'publish_at' => 'nullable|date',
            'attachments.*' => 'file|mimes:pdf,doc,docx|max:10240',
        ]);

        $was = $concurso->status;
        $concurso->update($data);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('concursos', 'public');
                $concurso->attachments()->create([
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        // If changed to published, notify
        if ($concurso->status === 'published' && $was !== 'published') {
            try {
                Mail::to(['dpto.rhas@isp-bie.ao','geral@isp-bie.ao'])->queue(new ConcursoPublished($concurso));
                $this->queueConcursoAlertsToSubscribers($concurso);
            } catch (\Throwable $e) {
                try {
                    Mail::to(['dpto.rhas@isp-bie.ao','geral@isp-bie.ao'])->send(new ConcursoPublished($concurso));
                    $this->sendConcursoAlertsToSubscribersSync($concurso);
                } catch (\Throwable $e2) {
                    \Log::error('Falha ao enviar email de concurso publicado: '.$e2->getMessage());
                }
            }
        }

        return redirect()->route('admin.concursos.index')->with('status', 'Concurso atualizado.');
    }

    /**
     * Queue notification emails to consenting subscribers in batches.
     */
    protected function queueConcursoAlertsToSubscribers(\App\Models\Concurso $concurso)
    {
        try {
            $emails = \App\Models\ConcursoAlert::where('consent', true)
                ->whereNotNull('email')
                ->pluck('email')
                ->unique()
                ->filter()
                ->values();

            // exclude internal addresses already notified
            $exclude = ['dpto.rhas@isp-bie.ao','geral@isp-bie.ao'];
            $emails = $emails->reject(function ($e) use ($exclude) { return in_array($e, $exclude); });

            $chunkSize = 100; // adjust based on queue/provider limits
            $emails->chunk($chunkSize)->each(function ($chunk) use ($concurso) {
                try {
                    Mail::to($chunk->toArray())->queue(new ConcursoPublished($concurso));
                } catch (\Throwable $e) {
                    \Log::error('Falha ao enfileirar alertas para concuso subscribers: '.$e->getMessage());
                }
            });
        } catch (\Throwable $e) {
            \Log::error('Erro ao preparar lista de assinantes para alerts: '.$e->getMessage());
        }
    }

    /**
     * Synchronous fallback to send alerts to subscribers (used when queue unavailable).
     */
    protected function sendConcursoAlertsToSubscribersSync(\App\Models\Concurso $concurso)
    {
        try {
            $emails = \App\Models\ConcursoAlert::where('consent', true)
                ->whereNotNull('email')
                ->pluck('email')
                ->unique()
                ->filter()
                ->values();

            $exclude = ['dpto.rhas@isp-bie.ao','geral@isp-bie.ao'];
            $emails = $emails->reject(function ($e) use ($exclude) { return in_array($e, $exclude); });

            $chunkSize = 100;
            $emails->chunk($chunkSize)->each(function ($chunk) use ($concurso) {
                try {
                    Mail::to($chunk->toArray())->send(new ConcursoPublished($concurso));
                } catch (\Throwable $e) {
                    \Log::error('Falha ao enviar alertas sincronamente: '.$e->getMessage());
                }
            });
        } catch (\Throwable $e) {
            \Log::error('Erro no envio sincronico de alerts: '.$e->getMessage());
        }
        }

    public function destroy(Concurso $concurso)
    {
        // delete attached files
        foreach ($concurso->attachments as $att) {
            try {
                // attachments may be stored with a 'public/' prefix from older code,
                // normalize and delete from the public disk
                // use # delimiters to avoid needing escaped slashes in the pattern
                $p = preg_replace('#^public/#', '', $att->path);
                Storage::disk('public')->delete($p);
            } catch (\Throwable $e) { }
        }
        $concurso->delete();
        return redirect()->route('admin.concursos.index')->with('status', 'Concurso removido.');
    }

    public function destroyAttachment($id)
    {
        $att = ConcursoAttachment::findOrFail($id);
        try {
            // normalize any legacy 'public/' prefix
            $p = preg_replace('#^public/#', '', $att->path);
            Storage::disk('public')->delete($p);
        } catch (\Throwable $e) { }
        $att->delete();
        return back()->with('status', 'Anexo removido.');
    }

    /**
     * Manually trigger resending alerts for a specific concurso.
     */
    public function resendAlerts(Concurso $concurso)
    {
        try {
            $this->queueConcursoAlertsToSubscribers($concurso);
            return back()->with('status', 'Envio de alertas enfileirado para este concurso.');
        } catch (\Throwable $e) {
            \Log::error('Falha ao reenviar alertas para concurso '.$concurso->id.': '.$e->getMessage());
            return back()->withErrors('Falha ao enfileirar envio de alertas. Verifique os logs.');
        }
    }

    /**
     * Admin: list subscriptions to concurso alerts
     */
    public function alerts(Request $request)
    {
        // By default show only subscribers who gave consent. Pass ?all=1 to show everyone.
        $query = ConcursoAlert::query();

        if (! $request->boolean('all')) {
            $query->where('consent', true);
        }

        $alerts = $query->orderByDesc('created_at')->paginate(25)->appends($request->only('all'));
        return view('admin.concursos.alerts', compact('alerts'));
    }

    /**
     * Export alerts as CSV. Respects the same `all` query param (default: only consent=true).
     */
    public function alertsExport(Request $request)
    {
        $query = ConcursoAlert::query();
        if (! $request->boolean('all')) {
            $query->where('consent', true);
        }

        $alerts = $query->orderByDesc('created_at')->get();

        $filename = 'concurso_alerts_'.now()->format('Ymd_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($alerts) {
            $out = fopen('php://output', 'w');
            // BOM for UTF-8 in some spreadsheet apps
            fprintf($out, "%s", chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($out, ['id','name','email','phone','interests','consent','created_at']);
            foreach ($alerts as $a) {
                $interests = is_array($a->interests) ? implode('; ', $a->interests) : ($a->interests ?? '');
                fputcsv($out, [
                    $a->id,
                    $a->name,
                    $a->email,
                    $a->phone,
                    $interests,
                    $a->consent ? 'Sim' : 'Nao',
                    $a->created_at ? $a->created_at->toDateTimeString() : '',
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * List subscribers that match a specific concurso's area.
     */
    public function subscribers(Request $request, Concurso $concurso)
    {
        $query = ConcursoAlert::query();

        if (! $request->boolean('all')) {
            $query->where('consent', true);
        }

        // If concurso has an area, prefer explicit JSON contains match
        if ($concurso->area) {
            $query->whereJsonContains('interests', $concurso->area);
        }

        if ($q = $request->input('q')) {
            $query->where(function ($q2) use ($q) {
                $q2->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%");
            });
        }

        $subscribers = $query->orderByDesc('created_at')->paginate(25)->withQueryString();
        return view('admin.concursos.subscribers', compact('subscribers', 'concurso'));
    }

    /**
     * Export subscribers for a specific concurso.
     */
    public function subscribersExport(Request $request, Concurso $concurso)
    {
        $query = ConcursoAlert::query();
        if (! $request->boolean('all')) {
            $query->where('consent', true);
        }
        if ($concurso->area) {
            $query->whereJsonContains('interests', $concurso->area);
        }
        if ($q = $request->input('q')) {
            $query->where(function ($q2) use ($q) {
                $q2->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%");
            });
        }

        $alerts = $query->orderByDesc('created_at')->get();

        $filename = 'concurso_'.$concurso->id.'_subscribers_'.now()->format('Ymd_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($alerts) {
            $out = fopen('php://output', 'w');
            fprintf($out, "%s", chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($out, ['id','name','email','phone','interests','consent','created_at']);
            foreach ($alerts as $a) {
                $interests = is_array($a->interests) ? implode('; ', $a->interests) : ($a->interests ?? '');
                fputcsv($out, [
                    $a->id,
                    $a->name,
                    $a->email,
                    $a->phone,
                    $interests,
                    $a->consent ? 'Sim' : 'Nao',
                    $a->created_at ? $a->created_at->toDateTimeString() : '',
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }
}
