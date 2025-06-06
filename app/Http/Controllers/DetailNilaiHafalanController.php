<?php

namespace App\Http\Controllers;

use App\Models\DetailNilaiHafalan;
use App\Models\MonitoringSemester;
use App\Models\SuratHafalan;
use Illuminate\Http\Request;

class DetailNilaiHafalanController extends Controller
{
    public function index()
    {
        $data = DetailNilaiHafalan::with(['rapor', 'surat'])->get();
        return view('detail_nilai_hafalan.index', compact('data'));
    }

        public function create()
    {
        // Cari ID terakhir
        $last = DetailNilaiHafalan::orderBy('id_detail_nilai_hafalan', 'desc')->first();
        $nextNumber = $last ? (int)substr($last->id_detail_nilai_hafalan, 3) + 1 : 1;

        // Format ke DHT001, DHT002, dst.
        $newId = 'DHT' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('detail_nilai_hafalan.form', [
            'item' => new DetailNilaiHafalan(['id_detail_nilai_hafalan' => $newId]),
            'rapor' => MonitoringSemester::all(),
            'surat' => SuratHafalan::all(),
            'nilai_options' => ['Mumtaz', 'Jayyid Jiddan', 'Jayyid', 'Maqbul'],
            'action' => route('detail_nilai_hafalan.store'),
            'method' => 'POST'
        ]);
    }

        public function store(Request $request)
    {
        $request->validate([
            'id_detail_nilai_hafalan' => 'required|unique:detail_nilai_hafalan',
            'id_rapor' => 'required',
            'id_surat' => 'required',
            'nilai' => 'required|in:Mumtaz,Jayyid Jiddan,Jayyid,Maqbul'
        ]);

        DetailNilaiHafalan::create($request->all());
        return redirect()->route('detail_nilai_hafalan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id_detail_nilai_hafalan)
    {
        $item = DetailNilaiHafalan::findOrFail($id_detail_nilai_hafalan);
        return view('detail_nilai_hafalan.form', [
            'item' => $item,
            'rapor' => MonitoringSemester::all(),
            'surat' => SuratHafalan::all(),
            'nilai_options' => ['Mumtaz', 'Jayyid Jiddan', 'Jayyid', 'Maqbul'],
            'action' => route('detail_nilai_hafalan.update', $id_detail_nilai_hafalan),
            'method' => 'PUT'
        ]);
    }

        public function update(Request $request, $id_detail_nilai_hafalan)
    {
        $request->validate([
            'id_rapor' => 'required',
            'id_surat' => 'required',
            'nilai' => 'required|in:Mumtaz,Jayyid Jiddan,Jayyid,Maqbul'
        ]);

        $item = DetailNilaiHafalan::findOrFail($id_detail_nilai_hafalan);
        $item->update([
            'id_rapor' => $request->id_rapor,
            'id_surat' => $request->id_surat,
            'nilai' => $request->nilai
        ]);

        return redirect()->route('detail_nilai_hafalan.index')->with('success', 'Data berhasil diubah');
    }


    public function destroy($id_detail_nilai_hafalan)
    {
        DetailNilaiHafalan::destroy($id_detail_nilai_hafalan);
        return redirect()->route('detail_nilai_hafalan.index')->with('success', 'Data berhasil dihapus');
    }
}
