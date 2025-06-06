@extends('layouts.app')
@section('title', 'Data Penilaian CP')
@section('content')

<div class="row page-titles mx-0 justify-content-between align-items-center">
    <div class="col-auto">
        <a href="{{ route('penilaian_cp.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Penilaian</a>
    </div>
    <div class="col-auto">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-body">
            <h4 class="card-title">@yield('title')</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Penilaian</th>
                            <th>Perkembangan</th>
                            <th>Aspek Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penilaian as $item)
                            <tr>
                                <td>{{ $item->id_penilaian_cp }}</td>
                                <td>{{ $item->perkembangan->indikator ?? '-' }}</td>
                                <td>{{ $item->aspek_nilai }}</td>
                                <td>
                                    <a href="{{ route('penilaian_cp.edit', $item->id_penilaian_cp) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('penilaian_cp.destroy', $item->id_penilaian_cp) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">Data tidak ditemukan</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
