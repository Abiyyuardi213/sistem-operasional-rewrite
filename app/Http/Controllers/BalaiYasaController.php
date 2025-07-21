<?php

namespace App\Http\Controllers;

use App\Models\BalaiYasa;
use App\Models\Kota;
use Illuminate\Http\Request;

class BalaiYasaController extends Controller
{
    public function index()
    {
        $balais = BalaiYasa::orderBy('created_at', 'asc')->get();
        return view('balai-yasa.index', compact('balais'));
    }

    public function create()
    {
        $kotas = Kota::all();
        return view('balai-yasa.create', compact('kotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_balai' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kota_id' => 'required|exists:kota,id',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'kepala_balai' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        BalaiYasa::createBalaiYasa($request->all());

        return redirect()->route('balai-yasa.index')->with('success', 'Data balai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $balai = BalaiYasa::findOrFail($id);
        $kotas = Kota::all();
        return view('balai-yasa.edit', compact('balai', 'kotas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_balai' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kota_id' => 'required|exists:kota,id',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'kepala_balai' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $balai = BalaiYasa::findOrFail($id);
        $balai->updateBalaiYasa($request->all());

        return redirect()->route('balai-yasa.index')->with('success', 'Data balai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $balai = BalaiYasa::findOrFail($id);
        $balai->deleteBalaiYasa();

        return redirect()->route('balai-yasa.index')->with('success', 'Data balai berhasil dihapus.');
    }

    public function show($id)
    {
        $balai = BalaiYasa::with('kota')->findOrFail($id);
        return view('balai-yasa.show', compact('balai'));
    }

    public function toggleStatus($id)
    {
        try {
            $balai = BalaiYasa::findOrFail($id);
            $balai->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status balai yasa berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
