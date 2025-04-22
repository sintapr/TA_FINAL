<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TujuanPembelajaran;

class TujuanPembelajaranController extends Controller
{
    public function index()
    {
        $tujuan = TujuanPembelajaran::all();
        return view('tujuan_pembelajaran.index', compact('tujuan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tp' => 'required|unique:tujuan_pembelajaran,id_tp|max:8',
            'tujuan_pembelajaran' => 'required',
        ]);

        TujuanPembelajaran::create($request->all());
        return redirect()->route('tujuan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tujuan_pembelajaran' => 'required',
        ]);

        $data = TujuanPembelajaran::findOrFail($id);
        $data->update(['tujuan_pembelajaran' => $request->tujuan_pembelajaran]);

        return redirect()->route('tujuan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        TujuanPembelajaran::destroy($id);
        return redirect()->route('tujuan.index')->with('success', 'Data berhasil dihapus');
    }
}
