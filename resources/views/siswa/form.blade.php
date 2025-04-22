@extends('layouts.app')
@section('title', isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa')
@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($siswa) ? 'Edit' : 'Tambah' }} Siswa</h4>
                        <div class="basic-form">
                            <form method="POST"
                                action="{{ $siswa->exists ? route('siswa.update', $siswa->NIS) : route('siswa.store') }}">
                                @csrf
                                @if ($siswa->exists)
                                    @method('PUT')
                                @endif

                                <div class="mb-3">
                                    <label>NIS</label>
                                    <input type="text" name="NIS" value="{{ old('NIS', $siswa->NIS) }}"
                                        class="form-control" {{ $siswa->exists ? 'readonly' : '' }}>
                                </div>
                                <div class="mb-3">
                                    <label>NIK</label>
                                    <input type="text" name="NIK" value="{{ old('NIK', $siswa->NIK) }}"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>NISN</label>
                                    <input type="text" name="NISN" value="{{ old('NISN', $siswa->NISN) }}"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Nama Siswa</label>
                                    <input type="text" name="nama_siswa"
                                        value="{{ old('nama_siswa', $siswa->nama_siswa) }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir"
                                        value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $siswa->tgl_lahir) }}"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Nama Kelas</label>
                                    <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $siswa->nama_kelas) }}"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Foto</label>
                                    <input type="text" name="foto" value="{{ old('foto', $siswa->foto) }}"
                                        class="form-control">
                                </div>
                                <button type="submit"
                                    class="btn btn-success">{{ $siswa->exists ? 'Update' : 'Simpan' }}</button>
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
