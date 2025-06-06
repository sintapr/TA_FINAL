@extends('layouts.app')
@section('title', 'Data Siswa')
@section('content')
    <div class="row page-titles mx-0 align-items-center justify-content-between">
        <div class="col-auto">
            <a href="{{ route('wali_kelas.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah Wali Kelas</a>
        </div>
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
                        <h4 class="card-title">@yield('title')</h4>
                        <form method="GET" action="{{ route('wali_kelas.index') }}" class="mb-3">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-4">
                                    <label for="id_ta" class="form-label">Filter Tahun Ajaran</label>
                                    <select name="id_ta" id="id_ta" class="form-control" onchange="this.form.submit()">
                                        @foreach ($tahunAjaranList as $ta)
                                            <option value="{{ $ta->id_ta }}" {{ $id_ta == $ta->id_ta ? 'selected' : '' }}>
                                                {{ $ta->tahun_ajaran }} - {{ ucfirst($ta->semester) }}
                                                {{ $ta->status ? '(Aktif)' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Wakel</th>
                                        <th>Nama Guru</th>
                                        <th>Kelas</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($waliKelas as $wakel)
                                        <tr>
                                            <td>{{ $wakel->id_wakel }}</td>
                                            <td>{{ $wakel->guru->nama_guru ?? '-' }}</td>
                                            <td>{{ $wakel->kelas->nama_kelas ?? '-' }}</td>
                                            <td>{{ $wakel->tahunAjaran->tahun_ajaran }} -
                                                {{ $wakel->tahunAjaran->semester_text }}</td>
                                            <td>
                                                <a href="{{ route('wali_kelas.edit', $wakel->id_wakel) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('wali_kelas.destroy', $wakel->id_wakel) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin hapus?')">Hapus</button>
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
