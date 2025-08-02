<?php

namespace App\Http\Controllers;

use App\Models\JenisKereta;
use Illuminate\Http\Request;

class JenisKeretaController extends Controller
{
    public function index()
    {
        $jenisKereta = JenisKereta::orderBy('created_at', 'asc')->get();
        return view('jenis-kereta.index', compact('jenisKereta'));
    }

    public function create()
    {
        return view('jenis-kereta.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
            'tahun' => 'string',
            'kelas' => 'string',
            'kecepatan_maks' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        JenisKereta::createJenisKereta($request->all());

        return redirect()->route('jenis-kereta.index')->with('success', 'Jenis kereta berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisKereta = JenisKereta::findOrFail($id);
        return view('jenis-kereta.edit', compact('jenisKereta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
            'tahun' => 'string',
            'kelas' => 'string',
            'kecepatan_maks' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $jenisKereta = JenisKereta::findOrFail($id);
        $jenisKereta->updateJenisKereta($request->all());

        return redirect()->route('jenis-kereta.index')->with('success', 'Jenis kereta berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenisKereta = JenisKereta::findOrFail($id);
        $jenisKereta->deleteJenisKereta();

        return redirect()->route('jenis-kereta.index')->with('success', 'Jenis kereta berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $jenisKereta = JenisKereta::findOrFail($id);
            $jenisKereta->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status jenis kereta berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
