@extends('layouts.app')
@section('title', $surat->exists ? 'Edit Surat Hafalan' : 'Tambah Surat Hafalan')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $surat->exists ? 'Edit' : 'Tambah' }} Surat Hafalan</h4>
            <form method="POST" action="{{ $surat->exists ? route('surat.update', $surat->id_surat) : route('surat.store') }}">
                @csrf
                @if($surat->exists)
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label>ID Surat</label>
                    <input type="text" name="id_surat" class="form-control @error('id_surat') is-invalid @enderror"
                        value="{{ old('id_surat', $surat->id_surat) }}" {{ $surat->exists ? 'readonly' : '' }}>
                    @error('id_surat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label>Nama Surat</label>
                    <input type="text" name="nama_surat" class="form-control @error('nama_surat') is-invalid @enderror"
                        value="{{ old('nama_surat', $surat->nama_surat) }}">
                    @error('nama_surat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label> Perkembangan</label>
                    <select name="id_perkembangan" class="form-control @error('id_perkembangan') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        @foreach ($perkembangan as $item)
                            <option value="{{ $item->id_perkembangan }}"
                                {{ old('id_perkembangan', $surat->id_perkembangan) == $item->id_perkembangan ? 'selected' : '' }}>
                                {{ $item->id_perkembangan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_perkembangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-success">{{ $surat->exists ? 'Update' : 'Simpan' }}</button>
                <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
