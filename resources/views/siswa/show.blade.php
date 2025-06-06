@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Detail Siswa</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <strong>{{ $siswa->nama_siswa }}</strong>
            <span class="badge {{ $siswa->status == 1 ? 'bg-success' : 'bg-danger' }}">
                {{ $siswa->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
            </span>
        </div>

        <div class="card-body">
            {{-- NIS --}}
            <div class="row mb-3">
                <div class="col-md-3 fw-bold text-end">NIS</div>
                <div class="col-md-9">{{ $siswa->NIS }}</div>
            </div>

            {{-- Nama Lengkap --}}
            <div class="row mb-3">
                <div class="col-md-3 fw-bold text-end">Nama Lengkap</div>
                <div class="col-md-9">{{ $siswa->nama_siswa }}</div>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="row mb-3">
                <div class="col-md-3 fw-bold text-end">Jenis Kelamin</div>
                <div class="col-md-9">{{ $siswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
            </div>

            {{-- Tanggal Lahir --}}
            <div class="row mb-3">
                <div class="col-md-3 fw-bold text-end">Tanggal Lahir</div>
                <div class="col-md-9">
                    {{ $siswa->tgl_lahir ? \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d-m-Y') : '-' }}
                </div>
            </div>

            {{-- Alamat --}}
            <div class="row mb-3">
                <div class="col-md-3 fw-bold text-end">Alamat</div>
                <div class="col-md-9">{{ $siswa->alamat ?? '-' }}</div>
            </div>

            {{-- Foto --}}
            <div class="row mb-3">
                <div class="col-md-3 fw-bold text-end">Foto</div>
                <div class="col-md-9">
                    @if ($siswa->foto)
                        <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama_siswa }}" class="img-thumbnail rounded" style="max-width: 150px;">
                    @else
                        <span class="text-muted">Tidak ada foto.</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Data Orangtua --}}
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <strong>Data Orangtua</strong>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-3 fw-bold text-end">Nama Ayah</div>
                    <div class="col-md-9">{{ $siswa->orangtua->nama_ayah ?? '-' }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 fw-bold text-end">Nama Ibu</div>
                    <div class="col-md-9">{{ $siswa->orangtua->nama_ibu ?? '-' }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 fw-bold text-end">Pekerjaan Ayah</div>
                    <div class="col-md-9">{{ $siswa->orangtua->pekerjaan_ayah ?? '-' }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 fw-bold text-end">Pekerjaan Ibu</div>
                    <div class="col-md-9">{{ $siswa->orangtua->pekerjaan_ibu ?? '-' }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 fw-bold text-end">Alamat</div>
                    <div class="col-md-9">{{ $siswa->orangtua->alamat ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- Data Wali Kelas --}}
        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                <strong>Data Wali Kelas & Kelas</strong>
            </div>
            <div class="card-body">
                @php
                    $anggota = $siswa->anggota_kelas->first();
                    $wali = $anggota->waliKelas ?? null;
                @endphp

                @if ($wali)
                    <div class="row mb-2">
                        <div class="col-md-3 fw-bold text-end">Nama Wali Kelas</div>
                        <div class="col-md-9">{{ $wali->guru->nama_guru ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 fw-bold text-end">Jabatan Wali Kelas</div>
                        <div class="col-md-9">{{ $wali->guru->jabatan ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 fw-bold text-end">Kelas</div>
                        <div class="col-md-9">{{ $wali->kelas->nama_kelas ?? '-' }}</div>
                    </div>
                @else
                    <div class="text-muted">Data wali kelas belum tersedia.</div>
                @endif
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('siswa.edit', $siswa->NIS) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
</div>
@endsection
