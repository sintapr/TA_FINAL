<?php

namespace App\Http\Controllers;

use App\Models\Orangtua;
use Illuminate\Http\Request;

class OrangtuaController extends Controller
{
    public function index()
    {
        $orangtua = Orangtua::all();
        return view('orangtua.index', compact('orangtua'));
    }

    public function create()
    {
        $orangtua = new Orangtua();
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

        Orangtua::create($request->all());

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
