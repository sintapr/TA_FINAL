@extends('layouts.app')
@section('title', 'Daftar Siswa Kelas ' . $wakel->kelas->nama_kelas)
@section('content')

<div class="row page-titles mx-0 align-items-center justify-content-between">
    <div class="col-auto">
        <h4 class="mb-0">@yield('title')</h4>
        <small>Tahun Ajaran: {{ $wakel->tahunAjaran->tahun }} - Semester: {{ $wakel->tahunAjaran->semester }}</small>
    </div>
    <div class="col-auto">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('laporan-assesment.index') }}">Daftar Kelas</a></li>
            <li class="breadcrumb-item active"><a href="#">@yield('title')</a></li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Siswa</th>
                            <th class="text-center">Sudah Muncul</th>
                            <th class="text-center">Minggu</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $item)
                        @php
                            $data = $assesments[$item->NIS] ?? collect();
                            $first = $data->first();
                        @endphp
                        <tr>
                            <td>{{ $item->siswa->nama_siswa }}</td>
                            <td class="text-center">{{ $first?->sudah_muncul ? 'Ya' : 'Tidak' }}</td>
                            <td class="text-center">{{ $first?->minggu ?? '-' }}</td>
                            <td class="text-center">{{ $first?->tahun_mulai ?? '-' }}</td>
                            <td class="text-center">
                                @if($first)
                                <a href="{{ route('laporan-assesment.showDetail', [$item->NIS, $first->id_tp]) }}" 
                                   class="btn btn-success btn-sm">Detail</a>
                                       <a href="{{ route('laporan.assesment.cetak', [$item->NIS, $wakel->id_kelas, $wakel->id_ta]) }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fa fa-file-pdf"></i> Cetak
                        </a>
                                @else
                                <span class="text-muted">Tidak Ada</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('laporan-assesment.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Kelas</a>
        </div>
    </div>
</div>

@endsection
