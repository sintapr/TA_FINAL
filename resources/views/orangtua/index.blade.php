@extends('layouts.app')
@section('title', 'Data Orang Tua')
@section('content')
<div class="row page-titles mx-0 align-items-center justify-content-between">
    <!-- Kiri: Tombol -->
    <div class="col-auto">
        <a href="{{ route('orangtua.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Orangtua</a>
    </div>

    <!-- Kanan: Breadcrumb -->
    <div class="col-auto">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orangtua.index') }}">@yield('title')</a></li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- data orangtua --}}
                    <h4 class="card-title"> @yield('title')</h4>
                    <div class="table-responsive">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NIS</th>
                            <th>Ayah</th>
                            <th>Ibu</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orangtua as $item)
                            <tr>
                                <td>{{ $item->id_ortu }}</td>
                                <td>{{ $item->NIS }}</td>
                                <td>{{ $item->nama_ayah }}</td>
                                <td>{{ $item->nama_ibu }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <a href="{{ route('orangtua.edit', $item->id_ortu) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('orangtua.destroy', $item->id_ortu) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
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
@endsection
