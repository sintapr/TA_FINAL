@extends('layouts.app')
@section('title', 'Detail Laporan Siswa')
@section('content')

<div class="row page-titles mx-0 align-items-center justify-content-between">
    <div class="col-auto">
        <h4 class="mb-0">@yield('title')</h4>
    </div>
    <div class="col-auto">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('laporan-assesment.index') }}">Daftar Kelas</a></li>
            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Daftar Siswa</a></li>
            <li class="breadcrumb-item active"><a href="#">@yield('title')</a></li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            @if ($detail->isEmpty())
                <p class="text-danger">Data tidak ditemukan.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Tujuan Pembelajaran</th>
                                <th>Konteks</th>
                                <th>Tempat & Waktu</th>
                                <th>Kejadian Teramati</th>
                                <th class="text-center">Minggu</th>
                                <th class="text-center">Tahun</th>
                                <th class="text-center">Sudah Muncul</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $item)
                            <tr>
                                <td>{{ $item->tujuan_pembelajaran->tujuan_pembelajaran ?? $item->id_tp }}</td>
                                <td>{{ $item->konteks }}</td>
                                <td>{{ $item->tempat_waktu }}</td>
                                <td>{{ $item->kejadian_teramati }}</td>
                                <td class="text-center">{{ $item->minggu }}</td>
                                <td class="text-center">{{ $item->tahun }}</td>
                                <td class="text-center">{{ $item->sudah_muncul ? 'Ya' : 'Tidak' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>

@endsection
