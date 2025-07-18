<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Pulau;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    public function index()
    {
        $pulaus = Pulau::where('status', 1)->get();
        $kotas = Kota::with('pulau')->orderBy('created_at')->get();
        return view('kota.index', compact('kotas', 'pulaus'));
    }

    public function create()
    {
        $pulaus = Pulau::where('status', 1)->get();
        return view('kota.create', compact('pulaus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pulau_id' => 'required|exists:pulau,id',
            'kota' => 'required|string|max:255|unique:kota,kota',
        ]);

        Kota::createKota($request->all());

        return redirect()->route('kota.index')->with('success', 'Kota berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kota = Kota::findOrFail($id);
        $pulaus = Pulau::all();
        return view('kota.index', compact('kota', 'pulaus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pulau_id' => 'required|exists:pulau,id',
            'kota' => 'required|string|max:255|unique:kota,kota,' . $id . ',id',
        ]);

        $kota = Kota::findOrFail($id);
        $kota->updateKota($request->all());

        return redirect()->route('kota.index')->with('success', 'Kota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kota = Kota::findOrFail($id);
        $kota->deleteKota();

        return redirect()->route('kota.index')->with('success', 'Kota berhasil dihapus.');
    }
}
