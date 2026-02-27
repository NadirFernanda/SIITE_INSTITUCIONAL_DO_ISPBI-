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

        // Apply search filter if provided
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function($r) use ($q) {
                $r->where('title', 'like', "%{$q}%")
                  ->orWhere('author', 'like', "%{$q}%")
                  ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // Apply category filter if provided
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // If there are filters or search, skip cache to return fresh results
        $hasFilters = $request->filled('q') || $request->filled('category') || $request->filled('status');

        if ($hasFilters) {
            $articles = $query->paginate(15)->withQueryString();
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
