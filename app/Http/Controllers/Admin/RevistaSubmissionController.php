<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RevistaSubmission;
use Illuminate\Http\Request;

class RevistaSubmissionController extends Controller
{
    public function index()
    {
        $query = RevistaSubmission::query();

        // Filters: status, search (title/author), category
        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }
        if (request()->filled('category')) {
            $query->where('category', request('category'));
        }
        if (request()->filled('q')) {
            $q = request('q');
            $query->where(function($r) use ($q) {
                $r->where('title', 'like', "%{$q}%")->orWhere('author', 'like', "%{$q}%");
            });
        }

        $submissions = $query->orderByDesc('created_at')->paginate(15)->withQueryString();
        return view('admin.revistas.index', compact('submissions'));
    }

    public function show($id)
    {
        $s = RevistaSubmission::findOrFail($id);
        return view('admin.revistas.show', compact('s'));
    }

    public function edit($id)
    {
        $s = RevistaSubmission::findOrFail($id);
        return view('admin.revistas.edit', compact('s'));
    }

    public function update(Request $request, $id)
    {
        $s = RevistaSubmission::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|url',
            'email' => 'required|email|max:255',
            'status' => 'required|in:pending,published',
        ]);

        $s->update($request->only(['title','author','description','link','email','affiliation','category','notes','status']));
        if ($s->status === 'published' && !$s->published_at) {
            $s->published_at = now();
            $s->save();
        }

        return redirect()->route('admin.revistas')->with('status', 'Submissão atualizada.');
    }

    public function publish($id)
    {
        $s = RevistaSubmission::findOrFail($id);
        $s->status = 'published';
        $s->published_at = now();
        $s->save();
        return redirect()->route('admin.revistas')->with('status', 'Artigo publicado.');
    }

    public function destroy($id)
    {
        $s = RevistaSubmission::findOrFail($id);
        $s->delete();
        return redirect()->route('admin.revistas')->with('status', 'Submissão eliminada.');
    }
}
