<?php

namespace App\Http\Controllers;

use App\Models\DetailRapor;
use App\Models\MonitoringSemester;
use App\Models\Perkembangan;
use Illuminate\Http\Request;

class DetailRaporController extends Controller
{
    public function index()
    {
        $detail_rapor = DetailRapor::with(['rapor', 'perkembangan'])->get();
        return view('detail_rapor.index', compact('detail_rapor'));
    }

    public function create()
{
    $lastId = DetailRapor::max('no_detail_rapor');
    $newId = 'DR001';

    if ($lastId) {
        $number = (int) substr($lastId, 2);
        $newId = 'DR' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);
    }

    return view('detail_rapor.form', [
        'detail' => new DetailRapor(['no_detail_rapor' => $newId]),
        'rapor' => MonitoringSemester::all(),
        'perkembangan' => Perkembangan::all(),
        'action' => route('detail_rapor.store'),
        'method' => 'POST',
    ]);
}


    public function store(Request $request)
    {
        $request->validate([
            'no_detail_rapor' => 'required|unique:detail_rapor',
            'id_rapor' => 'required',
            'id_perkembangan' => 'required',
        ]);

        DetailRapor::create($request->all());
        return redirect()->route('detail_rapor.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($no_detail_rapor)
    {
        $detail = DetailRapor::findOrFail($no_detail_rapor);
        return view('detail_rapor.form', [
            'detail' => $detail,
            'rapor' => MonitoringSemester::all(),
            'perkembangan' => Perkembangan::all(),
            'action' => route('detail_rapor.update', $no_detail_rapor),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, $no_detail_rapor)
    {
        $detail = DetailRapor::findOrFail($no_detail_rapor);
        $detail->update($request->all());
        return redirect()->route('detail_rapor.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($no_detail_rapor)
    {
        DetailRapor::destroy($no_detail_rapor);
        return redirect()->route('detail_rapor.index')->with('success', 'Data berhasil dihapus');
    }
}
