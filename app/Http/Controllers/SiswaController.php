<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('siswa.form', ['siswa' => new Siswa()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'NIS' => 'required|string|max:6|unique:siswa',
            'NIK' => 'nullable|string|max:16',
            'NISN' => 'nullable|string|max:10',
            'nama_siswa' => 'required|string|max:60',
            'tempat_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',            
            'nama_kelas' => 'nullable|string|max:16',
            'foto' => 'nullable|date',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('BERHASIL', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.form', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'NIK' => 'nullable|string|max:10',
            'NISN' => 'nullable|string|max:12',
            'nama_siswa' => 'required|string|max:60',
            'tempat_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'nama_kelas' => 'nullable|string|max:16',
            'foto' => 'nullable|date',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
