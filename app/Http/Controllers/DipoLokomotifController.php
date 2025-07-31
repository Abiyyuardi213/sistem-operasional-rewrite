<?php

namespace App\Http\Controllers;

use App\Models\Daops;
use App\Models\DipoLokomotif;
use App\Models\Kota;
use Illuminate\Http\Request;

class DipoLokomotifController extends Controller
{
    public function index()
    {
        $dipoLokomotif = DipoLokomotif::orderBy('created_at', 'asc')->get();
        return view('dipo-lokomotif.index', compact('dipoLokomotif'));
    }

    public function create()
    {
        $kotas = Kota::all();
        $daops = Daops::orderBy('nama_daop', 'asc')->get();
        return view('dipo-lokomotif.create', compact('kotas', 'daops'));
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

        DipoLokomotif::createDipoLokomotif($request->all());

        return redirect()->route('dipo-lokomotif.index')->with('success', 'Data dipo lokomotif berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dipoLokomotif = DipoLokomotif::findOrFail($id);
        $kotas = Kota::all();
        $daops = Daops::all();
        return view('dipo-lokomotif.edit', compact('dipoLokomotif', 'kotas', 'daops'));
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

        $dipoLokomotif = DipoLokomotif::findOrFail($id);
        $dipoLokomotif->updateDipoLokomotif($request->all());

        return redirect()->route('dipo-lokomotif.index')->with('success', 'Data dipo lokomotif berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dipoLokomotif = DipoLokomotif::findOrFail($id);
        $dipoLokomotif->deleteDipoLokomotif();

        return redirect()->route('dipo-lokomotif.index')->with('success', 'Data dipo lokomotif berhasil dihapus.');
    }

    public function show($id)
    {
        $dipoLokomotif = DipoLokomotif::with('kota', 'daop')->findOrFail($id);
        return view('dipo-lokomotif.show', compact('dipoLokomotif'));
    }

    public function toggleStatus($id)
    {
        try {
            $dipoLokomotif = DipoLokomotif::findOrFail($id);
            $dipoLokomotif->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status dipo lokomotif berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
