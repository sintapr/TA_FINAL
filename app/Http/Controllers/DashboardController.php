<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();
        $jumlahGuru = Guru::count();
        $tahun_ajaran = TahunAjaran::where('status', 'aktif')->first();

        $role = session('role', null);
        $user = null;

        if ($role == 'siswa') {
            $user = Auth::guard('siswa')->user();
        } elseif (in_array($role, ['admin', 'wali_kelas', 'kepala_sekolah'])) {
            $user = Auth::guard('guru')->user();
        } elseif ($role == 'orangtua') {
            $user = Auth::guard('orangtua')->user();
        }

        if (!$role || !$user) {
            abort(403, 'Unauthorized');
        }

        return view('dashboard', [
        'user' => $user,
        'role' => $role,
        'tahun_ajaran' => $tahun_ajaran,
        'rekapHasilBelajar' => $role === 'orangtua' ? $this->getRangkumanBelajar($user->siswa) : collect(),
        'jumlahSiswa' => Siswa::count(),
        'jumlahKelas' => Kelas::count(),
        'jumlahGuru' => Guru::count(),
    ]);
        // return view('dashboard', compact(
        //     'jumlahSiswa',
        //     'jumlahKelas',
        //     'jumlahGuru',
        //     'tahun_ajaran',
        //     'role',
        //     'user'
        // ));
    }
}
