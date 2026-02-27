<?php

namespace App\Http\Controllers;

use App\Models\RevistaSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RevistaController extends Controller
{
    public function index(Request $request)
    {
        $query = RevistaSubmission::where('status', 'published')
            ->select(['id','title','author','affiliation','published_at','description','link','created_at'])
            ->orderByDesc('published_at');

        // If there are filters or search, skip cache to return fresh results
        $hasFilters = $request->filled('q') || $request->filled('category') || $request->filled('status');

        if ($hasFilters) {
            $articles = $query->paginate(15);
        } else {
            $page = max(1, (int) $request->get('page', 1));
            $cacheKey = "revista:page:{$page}";
            // Cache for 5 minutes; uses default cache store (configure REDIS in production)
            $articles = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($query) {
                return $query->paginate(15);
            });
        }

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
