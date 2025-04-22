<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KondisiSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;

class KondisiSiswaController extends Controller
{
    public function index()
    {
        $kondisi = KondisiSiswa::with('siswa', 'tahunAjaran')->get();
        return view('kondisi_siswa.index', compact('kondisi'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $tahun = TahunAjaran::all();
        return view('kondisi_siswa.form', compact('siswa', 'tahun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kondisi' => 'required|unique:kondisi_siswa',
            'NIS' => 'required',
            'penglihatan' => 'required',
            'pendengaran' => 'required',
            'gigi' => 'required',
            'id_ta' => 'required',
        ]);

        KondisiSiswa::create($request->all());
        return redirect()->route('kondisi-siswa.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = KondisiSiswa::findOrFail($id);
        $siswa = Siswa::all();
        $tahun = TahunAjaran::all();
        return view('kondisi_siswa.form', compact('data', 'siswa', 'tahun'));
    }

    public function update(Request $request, $id)
    {
        $data = KondisiSiswa::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('kondisi-siswa.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $data = KondisiSiswa::findOrFail($id);
        $data->delete();
        return redirect()->route('kondisi-siswa.index')->with('success', 'Data berhasil dihapus.');
    }
}

