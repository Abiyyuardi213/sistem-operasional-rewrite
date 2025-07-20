<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use App\Models\Kota;
use Illuminate\Http\Request;

class KantorController extends Controller
{
    public function index()
    {
        $kantors = Kantor::with('kota')->orderBy('created_at', 'desc')->get();
        $kotas = Kota::orderBy('kota')->get();
        $jenisList = Kantor::getJenisList();

        return view('kantor.index', compact('kantors', 'kotas', 'jenisList'));
    }

    public function create()
    {
        $kotas = Kota::orderBy('kota')->get();
        $jenisList = Kantor::getJenisList();
        return view('kantor.create', compact('kotas', 'jenisList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kantor' => 'required|string|max:255|unique:kantor,nama_kantor',
            'jenis'       => 'required|string|max:100',
            'alamat'      => 'required|string',
            'kota_id'     => 'required|exists:kota,id',
            'telepon'     => 'nullable|string|max:20',
            'status'      => 'nullable|boolean',
        ]);

        Kantor::createKantor($request->all());

        return redirect()->route('kantor.index')->with('success', 'Kantor berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kantor = Kantor::findOrFail($id);
        $kotas = Kota::orderBy('kota')->get();
        $jenisList = Kantor::getJenisList();
        return view('kantor.edit', compact('kantor', 'kotas', 'jenisList'));
    }

    public function update(Request $request, $id)
    {
        $kantor = Kantor::findOrFail($id);

        $request->validate([
            'nama_kantor' => 'required|string|max:255|unique:kantor,nama_kantor,' . $id . ',id',
            'jenis'       => 'required|string|max:100',
            'alamat'      => 'required|string',
            'kota_id'     => 'required|exists:kota,id',
            'telepon'     => 'nullable|string|max:20',
            'status'      => 'nullable|boolean',
        ]);

        $kantor->updateKantor($request->all());

        return redirect()->route('kantor.index')->with('success', 'Kantor berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kantor = Kantor::findOrFail($id);
        $kantor->deleteKantor();

        return redirect()->route('kantor.index')->with('success', 'Kantor berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $kantor = Kantor::findOrFail($id);
        $kantor->toggleStatus();

        return redirect()->route('kantor.index')->with('success', 'Status kantor berhasil diubah.');
    }
}
