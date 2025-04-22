@extends('layouts.app')
@section('title', isset($kelas) ? 'Edit Kelas' : 'Tambah Kelas')
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
                        <h4 class="card-title">{{ isset($kelas) ? 'Edit' : 'Tambah' }} Kelas</h4>
                        <div class="basic-form">
                            <form method="POST"
                                action="{{ $kelas->exists ? route('kelas.update', $kelas->id_kelas) : route('kelas.store') }}">
                                @csrf
                                @if ($kelas->exists)
                                    @method('PUT')
                                @endif

                                <div class="mb-3">
                                    <label>Id Kelas</label>
                                    <input type="text" name="id_kelas" value="{{ old('id_kelas', $kelas->id_kelas) }}"
                                        class="form-control @error('id_kelas') is-invalid @enderror" {{ $kelas->exists ? 'readonly' : '' }}>
                                    @error('id_kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Nama Kelas</label>
                                    <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" 
                                    value="{{ old('nama_kelas', $kelas->nama_kelas) }}">
                                    @error('nama_kelas')<div class="invalid-feedback">{{ $message }}>
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="btn btn-success">{{ $kelas->exists ? 'Update' : 'Simpan' }}</button>
                                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
