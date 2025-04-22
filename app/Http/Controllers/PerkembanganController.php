<?php

namespace App\Http\Controllers;

use App\Models\Perkembangan;
use Illuminate\Http\Request;

class PerkembanganController extends Controller
{
    public function index()
    {
        $perkembangan = Perkembangan::all();
        return view('perkembangan.index', compact('perkembangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_perkembangan' => 'required|unique:perkembangan',
            'indikator' => 'nullable|string|max:60',
        ]);

        Perkembangan::create($request->all());
        return redirect()->route('perkembangan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'indikator' => 'nullable|string|max:60',
        ]);

        $perkembangan = Perkembangan::findOrFail($id);
        $perkembangan->update(['indikator' => $request->indikator]);

        return redirect()->route('perkembangan.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Perkembangan::findOrFail($id)->delete();
        return redirect()->route('perkembangan.index')->with('success', 'Data berhasil dihapus.');
    }
}
