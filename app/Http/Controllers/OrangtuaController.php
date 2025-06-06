<?php

namespace App\Http\Controllers;

use App\Models\Orangtua;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrangtuaController extends Controller
{
    public function index()
    {
        $orangtua = Orangtua::all();
        return view('orangtua.index', compact('orangtua'));
    }

    public function create()
{
    $lastOrtu = Orangtua::orderBy('id_ortu', 'desc')->first();

    if ($lastOrtu) {
        $lastNumber = (int) substr($lastOrtu->id_ortu, 2); // Ambil angka setelah "OT"
        $newId = 'OT' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $newId = 'OT001';
    }

    $orangtua = new Orangtua();
    $orangtua->id_ortu = $newId;

    return view('orangtua.form', compact('orangtua'));
}


    public function store(Request $request)
    {
        $request->validate([
            'id_ortu' => 'required|unique:orangtua,id_ortu|max:8',
            'NIS' => 'required|max:8',
            'nama_ayah' => 'required|max:155',
            'nama_ibu' => 'required|max:155',
            'pekerjaan_ayah' => 'nullable|max:50',
            'pekerjaan_ibu' => 'nullable|max:50',
            'alamat' => 'nullable|max:255',
        ]);

// Buat password dari tanggal lahir
// $passwordOrtu = \Carbon\Carbon::parse($request->tgl_lahir)->format('dmY');
// $hashedPasswordOrtu = Hash::make($passwordOrtu);

// Generate ID Ortu baru
$lastOrtu = Orangtua::orderBy('id_ortu', 'desc')->first();
if ($lastOrtu) {
    $lastNumber = (int) substr($lastOrtu->id_ortu, 2); // Ambil angka setelah "OT"
    $newIdOrtu = 'OT' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
} else {
    $newIdOrtu = 'OT001';
}

// Simpan data orangtua
 $passwordOrtu = Carbon::parse($request->tgl_lahir)->format('dmY');
 $hashedPasswordOrtu = Hash::make($passwordOrtu);

// Simpan password yang sudah di-hash, jangan simpan yang plaintext
Orangtua::create([
    'id_ortu' => $newIdOrtu,
    'NIS' => $request->NIS,
    'nama_ayah' => $request->nama_ayah ?? '-',
    'nama_ibu' => $request->nama_ibu ?? '-',
    'pekerjaan_ayah' => $request->pekerjaan_ayah,
    'pekerjaan_ibu' => $request->pekerjaan_ibu,
    'alamat' => $request->alamat,
    'password' => $hashedPasswordOrtu,
]);

        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $orangtua = Orangtua::findOrFail($id);
        return view('orangtua.form', compact('orangtua'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'NIS' => 'required|max:8',
            'nama_ayah' => 'required|max:155',
            'nama_ibu' => 'required|max:155',
            'pekerjaan_ayah' => 'nullable|max:50',
            'pekerjaan_ibu' => 'nullable|max:50',
            'alamat' => 'nullable|max:255',
        ]);

        $orangtua = Orangtua::findOrFail($id);
        $orangtua->update($request->except('id_ortu'));

        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Orangtua::destroy($id);
        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil dihapus.');
    }
}
