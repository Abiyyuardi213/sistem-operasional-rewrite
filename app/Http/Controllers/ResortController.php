<?php

namespace App\Http\Controllers;

use App\Models\KategoriResort;
use App\Models\Resort;
use Illuminate\Http\Request;

class ResortController extends Controller
{
    public function index()
    {
        $kategoris = KategoriResort::where('status', 1)->get();
        $resorts = Resort::with('kategori_resort')->orderBy('created_at')->get();
        return view('resort.index', compact('resorts', 'kategoris'));
    }

    public function create()
    {
        $kategoris = KategoriResort::where('status', 1)->get();
        return view('resort.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_resort,id',
            'nama_resort' => 'required|string|max:255|unique:kategori_resort,nama_resort',
            'kota_id' => 'required|exists:kota,id',
            'alamat' => 'nullable|string',
            'kepala_resort' => 'nullable|string',
            'telepon' => 'nullable|string',
        ]);

        Resort::createResort($request->all());

        return redirect()->route('resort.index')->with('success', 'Resort berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $resort = Resort::findOrFail($id);
        $kategoris = KategoriResort::all();
        return view('resort.index', compact('resort', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_resort,id',
            'nama_resort' => 'required|string|max:255|unique:resort,nama_resort,' . $id . ',id',
            'kota_id' => 'required|exists:kota,id',
            'alamat' => 'nullable|string',
            'kepala_resort' => 'nullable|string',
            'telepon' => 'nullable|string',
        ]);

        $resort = Resort::findOrFail($id);
        $resort->updateResort($request->all());

        return redirect()->route('resort.index')->with('success', 'Resort berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $resort = Resort::findOrFail($id);
        $resort->deleteResort();

        return redirect()->route('resort.index')->with('success', 'Resort berhasil dihapus.');
    }
}
