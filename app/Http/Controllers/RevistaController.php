<?php

namespace App\Http\Controllers;

use App\Models\RevistaSubmission;
use Illuminate\Http\Request;

class RevistaController extends Controller
{
    public function index(Request $request)
    {
        $query = RevistaSubmission::where('status', 'published');
        $articles = $query->orderByDesc('published_at')->paginate(10);
        return view('pages.revista', compact('articles'));
    }

    public function show($id)
    {
        $article = RevistaSubmission::where('status', 'published')->findOrFail($id);
        return view('pages.revista-show', compact('article'));
    }
}
