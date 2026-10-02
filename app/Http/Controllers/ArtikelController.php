<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $allArticles = Artikel::where('status', 'publish')
            ->orderByDesc('published_date')
            ->get();

        $perPage = 6;
        $currentPage = (int) $request->query('page', 1);
        $totalPages = max(1, (int) ceil($allArticles->count() / $perPage));

        $articles = $allArticles->forPage($currentPage, $perPage)->values();
        $featured = $articles->first();
        $others = $articles->skip(1)->values();

        return view('artikel', compact('articles', 'featured', 'others', 'currentPage', 'totalPages'));
    }

    public function show($id)
    {
        $article = Artikel::findOrFail($id);

        $related = Artikel::where('status', 'publish')
            ->where('id', '!=', $article->id)
            ->orderByDesc('published_date')
            ->take(3)
            ->get();

        return view('artikel-detail', compact('article', 'related'));
    }
}