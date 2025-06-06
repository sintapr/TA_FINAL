<?php

namespace App\Http\Controllers;

use App\Models\Assesment;
use App\Models\Siswa;
use App\Models\TujuanPembelajaran;
use Illuminate\Http\Request;

class AssesmentController extends Controller
{
    public function index()
    {
        
        $assesment = Assesment::with('siswa', 'tujuan_pembelajaran')->get();
        return view('assesment.index', compact('assesment'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $tp = TujuanPembelajaran::all();
    
        // Ambil ID terakhir dari tabel
        $last = Assesment::orderBy('id_assesment', 'desc')->first();
        if ($last) {
            $lastNumber = intval(substr($last->id_assesment, 2));
            $newId = 'AS' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newId = 'AS001';
        }
    
        return view('assesment.form', compact('siswa', 'tp', 'newId'));
    }
    

    public function store(Request $request)
{
    $request->validate([
        'NIS' => 'required',
        'id_tp' => 'required',
        'tempat_waktu' => 'required',
        'kejadian_teramati' => 'required',
        'minggu' => 'required',
        'bulan' => 'required',
        'tahun' => 'required|integer',
        'semester' => 'required',
    ]);

    // Generate ID seperti di create
    $last = Assesment::orderBy('id_assesment', 'desc')->first();
    if ($last) {
        $lastNumber = intval(substr($last->id_assesment, 2));
        $newId = 'AS' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $newId = 'AS001';
    }

    $data = $request->all();
    $data['id_assesment'] = $newId;

    Assesment::create($data);
    return redirect()->route('assesment.index')->with('success', 'Data berhasil ditambahkan.');
}


    public function edit($id_assesment)
    {
        $assesment = Assesment::findOrFail($id_assesment);
        $siswa = Siswa::all();
        $tp = TujuanPembelajaran::all();
        return view('assesment.form', compact('assesment', 'siswa', 'tp'));
    }

    public function update(Request $request, $id_assesment)
    {
        $request->validate([
            'NIS' => 'required',
            'id_tp' => 'required',
            'tempat_waktu' => 'required',
            'kejadian_teramati' => 'required',
            'minggu' => 'required',
            'bulan' => 'required',
            'tahun' => 'required|integer',
            'semester' => 'required',
        ]);

        $assesment = Assesment::findOrFail($id_assesment);
        $assesment->update($request->all());
        return redirect()->route('assesment.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id_assesment)
    {
        Assesment::destroy($id_assesment);
        return redirect()->route('assesment.index')->with('success', 'Data berhasil dihapus.');
    }
}
