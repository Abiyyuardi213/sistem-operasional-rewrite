<?php

namespace App\Http\Controllers;

use App\Models\Pulau;
use Illuminate\Http\Request;

class PulauController extends Controller
{
        public function index()
    {
        $pulaus = Pulau::orderBy('created_at', 'asc')->get();
        return view('pulau.index', compact('pulaus'));
    }

    public function create()
    {
        return view('pulau.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pulau' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        Pulau::createPulau($request->all());

        return redirect()->route('pulau.index')->with('success', 'Pulau berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pulau = Pulau::findOrFail($id);
        return view('pulau.edit', compact('pulau'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pulau' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $pulau = Pulau::findOrFail($id);
        $pulau->updatePulau($request->all());

        return redirect()->route('pulau.index')->with('success', 'Pulau berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pulau = Pulau::findOrFail($id);
        $pulau->deletePulau();

        return redirect()->route('pulau.index')->with('success', 'Pulau berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $pulau = Pulau::findOrFail($id);
            $pulau->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status pulau berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
