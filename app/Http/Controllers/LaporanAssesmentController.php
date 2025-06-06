<?php

namespace App\Http\Controllers;

use App\Models\WaliKelas;
use App\Models\AnggotaKelas;
use App\Models\Assesment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanAssesmentController extends Controller
{
    public function index()
    {
        $daftar = WaliKelas::with('kelas', 'tahunAjaran')->get();
        return view('laporan-assesment.index', compact('daftar'));
    }

    public function showByKelas($id_kelas, $id_ta)
    {
        $wakel = WaliKelas::where('id_kelas', $id_kelas)
                          ->where('id_ta', $id_ta)
                          ->firstOrFail();

        $siswa = AnggotaKelas::with('siswa')
            ->where('id_wakel', $wakel->id_wakel)
            ->get();

        $assesments = Assesment::whereIn('NIS', $siswa->pluck('NIS'))
            ->where('tahun', now()->year)
            ->get()
            ->groupBy('NIS');

        return view('laporan-assesment.siswa', compact('siswa', 'assesments', 'wakel'));
    }

    public function showDetail($nis)
{
    $detail = Assesment::with('tujuan_pembelajaran')
                ->where('NIS', $nis)
                ->orderBy('minggu')
                ->get();

    return view('laporan-assesment.detail', compact('detail'));
}

        public function cetakPdf($nis, $id_kelas, $id_ta)
    {
        $wakel = WaliKelas::where('id_kelas', $id_kelas)
                        ->where('id_ta', $id_ta)
                        ->with('kelas', 'tahunAjaran')
                        ->firstOrFail();

        $anggota = AnggotaKelas::with('siswa')
            ->where('id_wakel', $wakel->id_wakel)
            ->where('NIS', $nis)
            ->firstOrFail();

        $siswa = $anggota->siswa;

        $assesments = Assesment::where('NIS', $nis)
            ->with('tujuan_pembelajaran')
            // ->where('id_kelas', $id_kelas)
            // ->where('id_ta', $id_ta)
            ->orderBy('minggu')
            ->get();

        // Buat PDF dari view
        $pdf = Pdf::loadView('laporan-assesment.pdf', [
            'siswa' => $siswa,
            'kelas' => $wakel->kelas,
            'tahunAjaran' => $wakel->tahunAjaran,
            // 'fase' => $wakel->fase->nama_fase ?? '-',
            'assesments' => $assesments
        ]);

        return $pdf->stream('laporan-assessment-' . $siswa->nama . '.pdf');
    }
}


