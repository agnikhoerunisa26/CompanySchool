<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Support\ActivityLogger;
use Illuminate\Http\Request;

class EkstrakurikulerAdminController extends Controller
{
    public function index(Request $request)
    {
        $ekskuls = Ekstrakurikuler::orderBy('id')->get();

        $perPage = 5;
        $currentPage = (int) $request->query('page', 1);
        $totalPages = max(1, (int) ceil($ekskuls->count() / $perPage));
        $paged = $ekskuls->forPage($currentPage, $perPage)->values();

        return view('admin.ekstrakurikuler.index', [
            'ekskuls' => $paged,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'startNumber' => ($currentPage - 1) * $perPage,
            'totalData' => $ekskuls->count(),
        ]);
    }

    public function create()
    {
        return view('admin.ekstrakurikuler.form', [
            'ekskul' => null,
            'formAction' => route('admin.ekstrakurikuler.store'),
            'formTitle' => 'Tambah Program Baru',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|max:5120',
        ]);

        $imageName = 'eskul2.JPG'; // fallback kalau tidak upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $imageName);
        }

        $ekskul = Ekstrakurikuler::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status'],
            'image' => $imageName,
        ]);

        ActivityLogger::log('created', 'Ekstrakurikuler Baru Ditambahkan', '"' . $ekskul->name . '"', 'siswa-baru');

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Program ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);

        return view('admin.ekstrakurikuler.form', [
            'ekskul' => $ekskul,
            'formAction' => route('admin.ekstrakurikuler.update', $ekskul->id),
            'formTitle' => 'Edit Program Ekstrakurikuler',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|max:5120',
        ]);

        $ekskul = Ekstrakurikuler::findOrFail($id);

        $updateData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status'],
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $imageName);
            $updateData['image'] = $imageName;
        }

        $ekskul->update($updateData);

        ActivityLogger::log('updated', 'Ekstrakurikuler Diperbarui', '"' . $ekskul->name . '"');

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Program ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);
        $name = $ekskul->name;
        $ekskul->delete();

        ActivityLogger::log('deleted', 'Ekstrakurikuler Dihapus', '"' . $name . '"');

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Berhasil menghapus program ekstrakurikuler.');
    }
}