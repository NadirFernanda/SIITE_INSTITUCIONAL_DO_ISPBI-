<?php

namespace App\Http\Controllers;

use App\Models\RevistaSubmission;
use Illuminate\Http\Request;

class RevistaController extends Controller
{
    public function index(Request $request)
    {
        $query = RevistaSubmission::where('status', 'published')
            ->select(['id','title','author','affiliation','published_at','description','link','created_at'])
            ->orderByDesc('published_at');

        // Use cursor pagination for scalable performance with large datasets
        $articles = $query->cursorPaginate(15);
        return view('pages.revista', compact('articles'));
    }

    public function show($id)
    {
        $article = RevistaSubmission::where('status', 'published')
            ->select(['id','title','author','affiliation','published_at','description','link','created_at'])
            ->findOrFail($id);

        return view('pages.revista-show', compact('article'));
    }
}
