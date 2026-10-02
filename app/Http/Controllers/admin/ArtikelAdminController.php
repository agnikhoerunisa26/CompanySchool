<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Support\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $allArticles = $query->orderByDesc('published_date')->get();

        $totalArtikel = Artikel::count();
        $totalPublish = Artikel::where('status', 'publish')->count();

        $perPage = 4;
        $currentPage = (int) $request->query('page', 1);
        $totalPages = max(1, (int) ceil($allArticles->count() / $perPage));
        $paged = $allArticles->forPage($currentPage, $perPage)->values();

        return view('admin.artikel.index', [
            'articles' => $paged,
            'totalArtikel' => $totalArtikel,
            'totalPublish' => $totalPublish,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'search' => $request->search,
            'startNumber' => ($currentPage - 1) * $perPage,
            'totalData' => $allArticles->count(),
        ]);
    }

    public function create()
    {
        return view('admin.artikel.form', [
            'article' => null,
            'formAction' => route('admin.artikel.store'),
            'formTitle' => 'Tambah Artikel Baru',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'publish_date' => 'nullable|date',
            'status' => 'nullable|string',
            'foto_sampul' => 'nullable|image|max:5120',
        ]);

        $imageName = 'berita1.jpg';
        if ($request->hasFile('foto_sampul')) {
            $file = $request->file('foto_sampul');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $imageName);
        }

        $artikel = Artikel::create([
            'title' => $data['title'],
            'badge' => null,
            'image' => $imageName,
            'excerpt' => Str::limit(strip_tags($data['content']), 150),
            'content' => $data['content'],
            'published_date' => $data['publish_date'] ?? now()->format('Y-m-d'),
            'status' => $data['status'] ?? 'publish',
        ]);

        ActivityLogger::log('created', 'Artikel Baru Ditambahkan', '"' . $artikel->title . '"');

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $article = Artikel::findOrFail($id);

        return view('admin.artikel.form', [
            'article' => $article,
            'formAction' => route('admin.artikel.update', $article->id),
            'formTitle' => 'Edit Artikel',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'publish_date' => 'nullable|date',
            'status' => 'nullable|string',
            'foto_sampul' => 'nullable|image|max:5120',
        ]);

        $article = Artikel::findOrFail($id);

        if ($request->hasFile('foto_sampul')) {
            $file = $request->file('foto_sampul');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $imageName);
            $article->image = $imageName;
        }

        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->excerpt = Str::limit(strip_tags($data['content']), 150);
        $article->published_date = $data['publish_date'] ?? $article->published_date;
        $article->status = $data['status'] ?? $article->status;
        $article->save();

        ActivityLogger::log('updated', 'Artikel Diperbarui', '"' . $article->title . '"');

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $article = Artikel::findOrFail($id);
        $title = $article->title;
        $article->delete();

        ActivityLogger::log('deleted', 'Artikel Dihapus', '"' . $title . '"');

        return redirect()->route('admin.artikel.index')->with('success', 'Berhasil menghapus artikel.');
    }
}