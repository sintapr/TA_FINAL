@extends('layouts.app')
@section('title', 'Siswa')
@section('content')
    <div class="row page-titles mx-0 align-items-center justify-content-between">
        <!-- Kiri: Tombol -->
        <div class="col-auto">
            <a href="{{ route('siswa.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah Siswa</a>
        </div>

        <!-- Kanan: Breadcrumb -->
        <div class="col-auto">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('siswa.index') }}">@yield('title')</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data @yield('title')</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>NISN</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tgl Lahir</th>
                                        <th>Nama Kelas</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $s)
                                        <tr>
                                            <td>{{ $s->NIS }}</td>
                                            <td>{{ $s->nama_siswa }}</td>
                                            <td>{{ $s->NIK }}</td>
                                            <td>{{ $s->NISN }}</td>
                                            <td>{{ $s->tempat_lahir }}</td>
                                            <td>{{ $s->tgl_lahir }}</td>
                                            <td>{{ $s->nama_kelas }}</td>
                                            <td>{{ $s->foto }}</td>
                                            <td>
                                                <a href="{{ route('siswa.edit', $s->NIS) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('siswa.destroy', $s->NIS) }}" method="POST"
                                                    class="form-delete" style="display:inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">                                            
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
