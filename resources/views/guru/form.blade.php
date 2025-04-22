@extends('layouts.app')
@section('title', $guru->exists ? 'Edit Guru' : 'Tambah Guru')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">
                <h4>{{ $guru->exists ? 'Edit' : 'Tambah' }} Guru</h4>
                <form method="POST" action="{{ $guru->exists ? route('guru.update', $guru->NIP) : route('guru.store') }}">
                    @csrf
                    @if($guru->exists)
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label>NIP</label>
                        <input type="text" name="NIP" value="{{ old('NIP', $guru->NIP) }}"
                            class="form-control @error('NIP') is-invalid @enderror" {{ $guru->exists ? 'readonly' : '' }}>
                        @error('NIP')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Nama Guru</label>
                        <input type="text" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}"
                            class="form-control @error('nama_guru') is-invalid @enderror">
                        @error('nama_guru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Jabatan</label>
                        <select name="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach(['Kepala Sekolah', 'Wali Kelas', 'Admin'] as $j)
                                <option value="{{ $j }}" {{ old('jabatan', $guru->jabatan) == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $guru->tgl_lahir ? $guru->tgl_lahir->format('Y-m-d') : '') }}"
                            class="form-control @error('tgl_lahir') is-invalid @enderror">
                        @error('tgl_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ $guru->exists ? 'Update' : 'Simpan' }}</button>
                    <a href="{{ route('guru.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
