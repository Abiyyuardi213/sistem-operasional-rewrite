<?php

namespace App\Http\Controllers;

use App\Models\Daops;
use App\Models\DipoKereta;
use App\Models\Kota;
use Illuminate\Http\Request;

class DipoKeretaController extends Controller
{
    public function index()
    {
        $dipoKereta = DipoKereta::orderBy('created_at', 'asc')->get();
        return view('dipo-kereta.index', compact('dipoKereta'));
    }

    public function create()
    {
        $kotas = Kota::all();
        $daops = Daops::orderBy('nama_daop', 'asc')->get();
        return view('dipo-kereta.create', compact('kotas', 'daops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dipo' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'kepala_dipo' => 'nullable|string',
            'kota_id' => 'required|exists:kota,id',
            'daop_id' => 'required|exists:daops,id',
            'status' => 'required|boolean',
        ]);

        DipoKereta::createDipoKereta($request->all());

        return redirect()->route('dipo-kereta.index')->with('success', 'Data dipo kereta berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dipoKereta = DipoKereta::findOrFail($id);
        $kotas = Kota::all();
        $daops = Daops::all();
        return view('dipo-kereta.edit', compact('dipoKereta', 'kotas', 'daops'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_dipo' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'kepala_dipo' => 'nullable|string',
            'kota_id' => 'required|exists:kota,id',
            'daop_id' => 'required|exists:daops,id',
            'status' => 'required|boolean',
        ]);

        $dipoKereta = DipoKereta::findOrFail($id);
        $dipoKereta->updateDipoKereta($request->all());

        return redirect()->route('dipo-kereta.index')->with('success', 'Data dipo kereta berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dipoKereta = DipoKereta::findOrFail($id);
        $dipoKereta->deleteDipoKereta();

        return redirect()->route('dipo-kereta.index')->with('success', 'Data dipo kereta berhasil dihapus.');
    }

    public function show($id)
    {
        $dipoKereta = DipoKereta::with('kota', 'daop')->findOrFail($id);
        return view('dipo-kereta.show', compact('dipoKereta'));
    }

    public function toggleStatus($id)
    {
        try {
            $dipoKereta = DipoKereta::findOrFail($id);
            $dipoKereta->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status dipo kereta berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
