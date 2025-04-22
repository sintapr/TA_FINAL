<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Perkembangan;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $surat = Surat::with('perkembangan')->get();
        return view('surat.index', compact('surat'));
    }

    public function create()
    {
        $perkembangan = Perkembangan::all();
        $surat = new Surat();
        return view('surat.form', compact('surat', 'perkembangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_surat' => 'required|unique:surat_hafalan,id_surat',
            'nama_surat' => 'required|max:15',
            'id_perkembangan' => 'required|exists:perkembangan,id_perkembangan',
        ]);

        Surat::create($request->all());
        $perkembangan = Perkembangan::all();
        return redirect()->route('surat.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $perkembangan = Perkembangan::all();
        return view('surat.form', compact('surat', 'perkembangan'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $request->validate([
            'nama_surat' => 'required|max:15',
            'id_perkembangan' => 'required|exists:perkembangan,id_perkembangan',
        ]);

        $surat->update($request->all());
        return redirect()->route('surat.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        Surat::destroy($id);
        return redirect()->route('surat.index')->with('success', 'Data berhasil dihapus.');
    }
}
