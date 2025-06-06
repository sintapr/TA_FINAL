@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
           @if($role == 'orangtua')
            <h3>Selamat datang, {{ $user->nama_ortu }}</h3>
            <p>Anak anda: {{ $user->siswa->nama_siswa ?? '-' }}</p>
            @elseif ($role === 'siswa')
                <h3 class="fw-semibold">Selamat Datang, <span class="text-primary">{{ $user->nama_siswa ?? '-' }}</span></h3>
            @elseif (in_array($role, ['admin', 'wali_kelas', 'kepala_sekolah']))
                <h3 class="fw-semibold">Selamat Datang, Bapak/Ibu <span class="text-primary">{{ $user->nama_guru ?? '-' }}</span></h3>
            @else
                <h3 class="fw-semibold">Selamat Datang di Dashboard</h3>
            @endif
            <p class="text-muted">Semoga hari Anda menyenangkan.</p>
        </div>
        <div class="text-end">
            <div class="fw-bold text-dark" id="tanggal"></div>
            <div class="fw-semibold text-primary" id="jam"></div>
        </div>
    </div>

    @if($role === 'orangtua')
        {{-- Orangtua Section --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="fw-semibold mb-3 text-primary">Informasi Sekolah</h5>
                <p>TK Islam Taruna Al Qur'an adalah lembaga pendidikan yang berfokus pada pembentukan karakter anak sejak usia dini melalui pendekatan islami dan pembelajaran aktif.</p>
                <div class="text-center mt-3">
                    <img src="{{ asset('images/tk_taruna_alquran.jpg') }}" alt="TK Islam Taruna Al Qur'an" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold text-success mb-3">Informasi Anak</h5>
                        <ul class="list-unstyled">
                            <li><strong>Nama:</strong> {{ $user->siswa->nama_siswa ?? '-' }}</li>
                            <li><strong>NIS:</strong> {{ $user->siswa->nis ?? '-' }}</li>
                            <li><strong>Kelas:</strong> {{ $user->siswa->kelas->nama_kelas ?? 'Belum terdaftar' }}</li>
                            <li><strong>Tahun Ajaran:</strong> {{ $tahun_ajaran->tahun_aktif ?? '-' }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold text-warning mb-3">Wali Kelas</h5>
                        <ul class="list-unstyled">
                            <li><strong>Nama:</strong> {{ $user->siswa->kelas->waliKelas->nama_guru ?? '-' }}</li>
                            <li><strong>Kontak:</strong> {{ $user->siswa->kelas->waliKelas->no_hp ?? '-' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Rangkuman Belajar --}}
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">
                <h5 class="fw-semibold text-info mb-3">Rangkuman Hasil Belajar</h5>
                @if($rekapHasilBelajar->isNotEmpty())
                    <ul class="list-group list-group-flush">
                        @foreach($rekapHasilBelajar as $hasil)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $hasil->tujuan_pembelajaran }}
                                <span class="badge bg-primary">{{ $hasil->status }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="text-end mt-3">
                        <a href="{{ route('laporan.rapor', ['nis' => $user->siswa->nis]) }}" class="btn btn-outline-primary">Lihat Detail Rapor</a>
                    </div>
                @else
                    <p class="text-muted">Belum ada data hasil belajar.</p>
                @endif
            </div>
        </div>

    @else
        {{-- Dashboard Admin, Wali, Kepala Sekolah --}}
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm gradient-1 text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Total Siswa</h5>
                                <h3>{{ $jumlahSiswa }}</h3>
                                <small>{{ $tahun_ajaran->tahun_aktif ?? 'Tahun Aktif' }}</small>
                            </div>
                            <i class="fa fa-users fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm gradient-2 text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Jumlah Kelas</h5>
                                <h3>{{ $jumlahKelas }}</h3>
                                <small>Aktif</small>
                            </div>
                            <i class="fa fa-building fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm gradient-3 text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Jumlah Guru</h5>
                                <h3>{{ $jumlahGuru }}</h3>
                                <small>Aktif</small>
                            </div>
                            <i class="fa fa-chalkboard-teacher fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection

@push('scripts')
<script>
    function updateClock() {
        const now = new Date();
        const optionsTanggal = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('tanggal').innerText = now.toLocaleDateString('id-ID', optionsTanggal);
        document.getElementById('jam').innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
@endpush
