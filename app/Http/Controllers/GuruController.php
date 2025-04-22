<?php
namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view('guru.index', compact('guru'));
    }

    public function create()
    {
        return view('guru.form', ['guru' => new Guru()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'NIP' => 'required|string|max:12|unique:guru,NIP',
            'nama_guru' => 'required|string|max:155',
            'jabatan' => 'required|in:Kepala Sekolah,Wali Kelas,Admin',
            'tgl_lahir' => 'required|date',
        ]);

        Guru::create($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit($NIP)
    {
        $guru = Guru::findOrFail($NIP);
        return view('guru.form', compact('guru'));
    }

    public function update(Request $request, $NIP)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:155',
            'jabatan' => 'required|in:Kepala Sekolah,Wali Kelas,Admin',
            'tgl_lahir' => 'required|date',
        ]);

        $guru = Guru::findOrFail($NIP);
        $guru->update($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($NIP)
    {
        $guru = Guru::findOrFail($NIP);
        Guru::delete();
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
