<?php
// app/Http/Controllers/TahunAjaranController.php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::all();
        return view('tahun_ajaran.index', compact('tahunAjaran'));
    }

    public function create()
    {
        return view('tahun_ajaran.form', ['tahunAjaran' => new TahunAjaran()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ta' => 'required|max:8|unique:tahun_ajaran,id_ta',
            'semester' => 'required|max:10',
            'tahun' => 'required|max:10',
        ]);

        TahunAjaran::create($request->all());
        return redirect()->route('tahun-ajaran.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        return view('tahun_ajaran.form', compact('tahunAjaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'semester' => 'required|max:10',
            'tahun' => 'required|max:10',
        ]);

        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->update($request->only(['semester', 'tahun'])); // id_ta tidak diubah
        return redirect()->route('tahun-ajaran.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        TahunAjaran::destroy($id);
        return redirect()->route('tahun-ajaran.index')->with('success', 'Data berhasil dihapus.');
    }
}
