<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use Illuminate\Http\Request;

class FaseController extends Controller
{
    public function index()
    {
        $fase = Fase::all();
        return view('fase.index', compact('fase'));
    }

    public function create()
    {
        return view('fase.form', ['fase' => new Fase()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_fase' => 'required|string|max:8|unique:fase,id_fase',
            'nama_fase' => 'required|string|max:13',
        ]);

        Fase::create($request->all());

        return redirect()->route('fase.index')->with('success', 'Fase berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $fase = Fase::findOrFail($id);
        return view('fase.form', compact('fase'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fase' => 'required|string|max:13',
        ]);

        $fase = Fase::findOrFail($id);
        $fase->update($request->only('nama_fase'));

        return redirect()->route('fase.index')->with('success', 'Fase berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $fase = Fase::findOrFail($id);
        $fase->delete();

        return redirect()->route('fase.index')->with('success', 'Fase berhasil dihapus.');
    }
}
