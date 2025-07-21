<?php

namespace App\Http\Controllers;

use App\Models\Daops;
use Illuminate\Http\Request;

class DaopsController extends Controller
{
    public function index()
    {
        $daops = Daops::orderBy('created_at', 'asc')->get();
        return view('daop.index', compact('daops'));
    }

    public function create()
    {
        return view('daop.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_daop' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        Daops::createDaop($request->all());

        return redirect()->route('daop.index')->with('success', 'Data daop berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $daop = Daops::findOrFail($id);
        return view('daop.edit', compact('daop'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_daop' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $daop = Daops::findOrFail($id);
        $daop->updateDaop($request->all());

        return redirect()->route('daop.index')->with('success', 'Data daop berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $daop = Daops::findOrFail($id);
        $daop->deleteDaop();

        return redirect()->route('daop.index')->with('success', 'Data daop berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $daop = Daops::findOrFail($id);
            $daop->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status daop berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
