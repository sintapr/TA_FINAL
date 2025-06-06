@extends('layouts.app')
@section('title', 'Data Assesment')
@section('content')
<div class="row page-titles mx-0 align-items-center justify-content-between">
    <div class="col-auto">
        <a href="{{ route('assesment.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Assesment</a>
    </div>
    <div class="col-auto">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">@yield('title')</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id Assesment</th>
                            <th>NIS</th>
                            <th>Tujuan</th>
                            <th>Konteks</th>
                            <th>Tempat dan Waktu Muncul</th>
                            <th>Kejadian Teramati</th>
                            <th>Minggu</th>
                            <th>Bulan</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assesment as $item)
                            <tr>
                                <td>{{ $item->id_assesment }}</td>
                                <td>{{ $item->siswa->nama_siswa ?? $item->NIS }}</td>
                                <td>{{ $item->tujuan_pembelajaran->tujuan_pembelajaran ?? $item->id_tp }}</td>
                                <td>{{ $item->konteks }}</td>
                                <td>{{ $item->tempat_waktu }}</td>
                                <td>{{ $item->kejadian_teramati }}</td>
                                <td>{{ $item->minggu }}</td>
                                <td>{{ $item->bulan }}</td>
                                <td>{{ $item->semester }}</td>
                                <td>
                                    <a href="{{ route('assesment.edit', $item->id_assesment) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i></a>
                                    <form action="{{ route('assesment.destroy', $item->id_assesment) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
