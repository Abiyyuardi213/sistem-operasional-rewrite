<?php

namespace App\Http\Controllers;

use App\Models\KategoriResort;
use Illuminate\Http\Request;

class KategoriResortController extends Controller
{
    public function index()
    {
        $kategoris = KategoriResort::orderBy('created_at', 'asc')->get();
        return view('kategori-resort.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori-resort.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        KategoriResort::createKategoriResort($request->all());

        return redirect()->route('kategori-resort.index')->with('success', 'Kategori resort berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = KategoriResort::findOrFail($id);
        return view('kategori-resort.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $kategori = KategoriResort::findOrFail($id);
        $kategori->updateKategoriResort($request->all());

        return redirect()->route('kategori-resort.index')->with('success', 'Kategori resort berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriResort::findOrFail($id);
        $kategori->deleteKategoriResort();

        return redirect()->route('kategori-resort.index')->with('success', 'Kategori resort berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $kategori = KategoriResort::findOrFail($id);
            $kategori->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status kategori resort berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
