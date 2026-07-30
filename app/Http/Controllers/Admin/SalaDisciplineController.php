<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sala;
use App\Models\SalaDiscipline;
use App\Models\CourseDiscipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaDisciplineController extends Controller
{
    public function edit(Sala $sala)
    {
        $sala->load(['candidaturas']);
        $disciplines = SalaDiscipline::where('sala_id', $sala->id)->orderBy('id')->get();

        // Try to determine the main course for this sala from assigned candidaturas
        $courseName = null;
        if ($sala->candidaturas->isNotEmpty()) {
            $courseName = $sala->candidaturas->first()->curso;
        }

        $courseDisciplines = collect();
        if ($courseName) {
            // Build a normalized map of course_name => collection to allow robust matching
            $all = CourseDiscipline::orderBy('id')->get();

            $normalize = function ($s) {
                // remove accents and non-alphanum, lowercase
                $s = (string) $s;
                $s = iconv('UTF-8', 'ASCII//TRANSLIT', $s);
                $s = strtolower($s);
                $s = preg_replace('/[^a-z0-9 ]+/', '', $s);
                $s = trim($s);
                return $s;
            };

            $map = [];
            foreach ($all as $row) {
                $key = $normalize($row->course_name);
                $map[$key][] = $row;
            }

            $candidates = $sala->candidaturas->pluck('curso')->unique()->values();
            foreach ($candidates as $cn) {
                $norm = $normalize($cn);
                // exact normalized match
                if (isset($map[$norm])) {
                    $courseDisciplines = collect($map[$norm]);
                    break;
                }
                // partial match: key contains norm or norm contains key
                foreach ($map as $k => $rows) {
                    if ($k !== '' && (str_contains($k, $norm) || str_contains($norm, $k))) {
                        $courseDisciplines = collect($rows);
                        break 2;
                    }
                }
            }
        }

        return view('admin.salas.disciplines', compact('sala', 'disciplines', 'courseDisciplines'));
    }

    public function update(Request $request, Sala $sala)
    {
        // Log payload for debugging when saves appear not to persist (also write raw payload to file)
        try {
            $raw = $request->all();
            \Log::info('SalaDiscipline update called for sala '.$sala->id, $raw);
            // append human-readable JSON to dedicated file for inspection
            @file_put_contents(storage_path('logs/sala_disciplines_payload.log'), date('c') . " - sala {$sala->id} - " . json_encode($raw, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) . PHP_EOL . PHP_EOL, FILE_APPEND | LOCK_EX);
        } catch (\Throwable $e) {
            \Log::error('Failed to write sala disciplines raw payload: ' . $e->getMessage());
        }

        // Pre-process payload: normalize malformed pairs (some browsers may send discipline and weight as separate array elements)
        $payload = $request->all();
        if (isset($payload['disciplines']) && is_array($payload['disciplines'])) {
            $raw = array_values($payload['disciplines']);
            $merged = [];
            for ($i = 0; $i < count($raw); $i++) {
                $item = $raw[$i];
                $hasDisc = isset($item['discipline']) && trim((string)$item['discipline']) !== '';
                $hasWeight = array_key_exists('weight', $item) && trim((string)($item['weight'] ?? '') ) !== '';

                if ($hasDisc && !$hasWeight) {
                    // try to consume following element if it only contains weight
                    $next = $raw[$i + 1] ?? null;
                    if ($next !== null && !isset($next['discipline']) && isset($next['weight'])) {
                        $merged[] = ['discipline' => trim((string)$item['discipline']), 'weight' => trim((string)$next['weight'])];
                        $i++; // skip next
                        continue;
                    }
                    // no following weight-only entry, preserve discipline with possible weight (or default to 0)
                    $merged[] = ['discipline' => trim((string)$item['discipline']), 'weight' => (isset($item['weight']) ? trim((string)$item['weight']) : '0')];
                    continue;
                }

                if ($hasWeight && !$hasDisc) {
                    // weight-only item: if last merged entry lacks weight (rare), attach it; otherwise create placeholder with empty discipline
                    $lastIdx = count($merged) - 1;
                    if ($lastIdx >= 0 && (!isset($merged[$lastIdx]['weight']) || trim((string)$merged[$lastIdx]['weight']) === '')) {
                        $merged[$lastIdx]['weight'] = trim((string)$item['weight']);
                    } else {
                        // create an entry with empty discipline (will be filtered later)
                        $merged[] = ['discipline' => '', 'weight' => trim((string)$item['weight'])];
                    }
                    continue;
                }

                // item contains both or neither; normalize
                $merged[] = [
                    'discipline' => isset($item['discipline']) ? trim((string)$item['discipline']) : '',
                    'weight' => isset($item['weight']) ? trim((string)$item['weight']) : '0',
                ];
            }

            // remove fully-empty rows (no discipline AND weight empty/zero)
            $clean = array_values(array_filter($merged, function ($d) {
                $name = trim($d['discipline'] ?? '');
                $weight = isset($d['weight']) ? trim((string) $d['weight']) : '';
                if ($name === '' && ($weight === '' || $weight === '0' || $weight === 0)) {
                    return false;
                }
                return true;
            }));

            $payload['disciplines'] = $clean;
            $request->replace($payload);
            \Log::info('SalaDiscipline payload cleaned', ['sala' => $sala->id, 'clean_count' => count($clean), 'raw_count' => count($raw), 'merged_count' => count($merged)]);
        }

        try {
            $data = $request->validate([
                'disciplines' => 'required|array',
                'disciplines.*.discipline' => 'required|string|max:191|distinct',
                'disciplines.*.weight' => 'required|integer|min:0|max:100',
            ], [
                'disciplines.required' => 'Adicione pelo menos uma disciplina.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning('Validation failed saving sala disciplines', ['sala' => $sala->id, 'errors' => $e->validator->errors()->all()]);
            throw $e;
        }

        DB::transaction(function () use ($sala, $data) {
            // Remove existing entries not present in payload
            $incoming = collect($data['disciplines'])->map(fn($d) => trim($d['discipline']))->filter()->values();

            // TEMPORARY SAFETY: do not delete existing disciplines automatically to avoid accidental data loss
            // Previously we removed records not present in the incoming payload. That caused existing
            // disciplines to disappear when the browser sent malformed payloads. Until the UI reliably
            // sends the full list, only create/update incoming ones.
            foreach ($data['disciplines'] as $d) {
                $name = trim($d['discipline']);
                if ($name === '') continue;
                SalaDiscipline::updateOrCreate(
                    ['sala_id' => $sala->id, 'discipline' => $name],
                    ['weight_percent' => (int) ($d['weight'] ?? 0)]
                );
            }

            // NOTE: Deletion of disciplines via UI is temporarily disabled to prevent accidental removal.
            // If explicit deletion is required, an admin can remove rows from the DB or we can add a
            // dedicated 'deleted' flag that the UI sets when users remove a discipline.

        });

        // Extra logging to help debug persistence issues: log how many rows exist after save
        try {
            $count = SalaDiscipline::where('sala_id', $sala->id)->count();
            \Log::info('SalaDisciplines saved for sala '.$sala->id, ['rows_after_save' => $count, 'incoming' => $data['disciplines']]);
        } catch (\Throwable $e) {
            \Log::error('Could not count SalaDisciplines after save: ' . $e->getMessage());
        }

        return redirect()->route('admin.salas.disciplines.edit', $sala)
            ->with('success', 'Disciplinas da sala atualizadas com sucesso.');
    }
}
