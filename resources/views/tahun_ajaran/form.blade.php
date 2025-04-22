@extends('layouts.app')
@section('title', $tahunAjaran->exists ? 'Edit Tahun Ajaran' : 'Tambah Tahun Ajaran')
@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('tahun-ajaran.index') }}">Tahun Ajaran</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $tahunAjaran->exists ? 'Edit' : 'Tambah' }} Tahun Ajaran</h4>
                        <div class="basic-form">
                            <form method="POST" action="{{ $tahunAjaran->exists ? route('tahun-ajaran.update', $tahunAjaran->id_ta) : route('tahun-ajaran.store') }}">
                                @csrf
                                @if ($tahunAjaran->exists)
                                    @method('PUT')
                                @endif

                                <div class="mb-3">
                                    <label>Id Tahun Ajaran</label>
                                    <input type="text" name="id_ta" value="{{ old('id_ta', $tahunAjaran->id_ta) }}"
                                        class="form-control @error('id_ta') is-invalid @enderror"
                                        {{ $tahunAjaran->exists ? 'readonly' : '' }}>
                                    @error('id_ta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Semester</label>
                                    <input type="text" name="semester" value="{{ old('semester', $tahunAjaran->semester) }}"
                                        class="form-control @error('semester') is-invalid @enderror">
                                    @error('semester')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Tahun</label>
                                    <input type="text" name="tahun" value="{{ old('tahun', $tahunAjaran->tahun) }}"
                                        class="form-control @error('tahun') is-invalid @enderror">
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success">{{ $tahunAjaran->exists ? 'Update' : 'Simpan' }}</button>
                                <a href="{{ route('tahun-ajaran.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
