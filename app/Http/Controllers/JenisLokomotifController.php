<?php

namespace App\Http\Controllers;

use App\Models\JenisLokomotif;
use Illuminate\Http\Request;

class JenisLokomotifController extends Controller
{
    public function index()
    {
        $jenisLok = JenisLokomotif::orderBy('created_at', 'asc')->get();
        return view('jenis-lokomotif.index', compact('jenisLok'));
    }

    public function create()
    {
        return view('jenis-lokomotif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
            'jenis_mesin' => 'string',
            'kecepatan_maks' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        JenisLokomotif::createJenisLokomotif($request->all());

        return redirect()->route('jenis-lokomotif.index')->with('success', 'Jenis lokomotif berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisLok = JenisLokomotif::findOrFail($id);
        return view('jenis-lokomotif.edit', compact('jenisLok'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
            'jenis_mesin' => 'string',
            'kecepatan_maks' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $jenisLok = JenisLokomotif::findOrFail($id);
        $jenisLok->updateJenisLokomotif($request->all());

        return redirect()->route('jenis-lokomotif.index')->with('success', 'Jenis lokomotif berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenisLok = JenisLokomotif::findOrFail($id);
        $jenisLok->deleteJenisLokomotif();

        return redirect()->route('jenis-lokomotif.index')->with('success', 'Jenis lokomotif berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $jenisLok = JenisLokomotif::findOrFail($id);
            $jenisLok->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status jenis lokomotif berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
