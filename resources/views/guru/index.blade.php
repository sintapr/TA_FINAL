@extends('layouts.app')
@section('title', 'Data Guru')

@section('content')
    <div class="row page-titles mx-0 align-items-center justify-content-between">
        <!-- Kiri: Tombol -->
        <div class="col-auto">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahGuru">
                <i class="fa fa-plus"></i> Tambah @yield('title')
            </button>
        </div>

        <!-- Kanan: Breadcrumb -->
        <div class="col-auto">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('guru.index') }}">@yield('title')</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Data Guru</h4>
                        <!-- Modal Tambah Guru -->
                        <div class="modal fade" id="modalTambahGuru" tabindex="-1" aria-labelledby="modalTambahGuruLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('guru.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Guru</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="NIP" class="form-label">NIP</label>
                                                <input type="text" name="NIP"
                                                    class="form-control @error('NIP') is-invalid @enderror"
                                                    value="{{ old('NIP') }}">
                                                @error('NIP')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama_guru" class="form-label">Nama Guru</label>
                                                <input type="text" name="nama_guru"
                                                    class="form-control @error('nama_guru') is-invalid @enderror"
                                                    value="{{ old('nama_guru') }}">
                                                @error('nama_guru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="jabatan" class="form-label">Jabatan</label>
                                                <select name="jabatan"
                                                    class="form-control @error('jabatan') is-invalid @enderror">
                                                    <option value="">-- Pilih Jabatan --</option>
                                                    <option value="Kepala Sekolah"
                                                        {{ old('jabatan') == 'Kepala Sekolah' ? 'selected' : '' }}>Kepala
                                                        Sekolah
                                                    </option>
                                                    <option value="Wali Kelas"
                                                        {{ old('jabatan') == 'Wali Kelas' ? 'selected' : '' }}>Wali Kelas
                                                    </option>
                                                    <option value="Admin"
                                                        {{ old('jabatan') == 'Admin' ? 'selected' : '' }}>
                                                        Admin
                                                    </option>
                                                </select>
                                                @error('jabatan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                <input type="date" name="tgl_lahir"
                                                    class="form-control @error('tgl_lahir') is-invalid @enderror"
                                                    value="{{ old('tgl_lahir') }}">
                                                @error('tgl_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $item)
                                    <tr>
                                        <td>{{ $item->NIP }}</td>
                                        <td>{{ $item->nama_guru }}</td>
                                        <td>{{ $item->jabatan }}</td>
                                        <td>{{ $item->tgl_lahir->format('d-m-Y') }}</td>
                                        <td>

                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEditGuru-{{ $item->NIP }}">
                                                
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <div class="modal fade" id="modalEditGuru-{{ $item->NIP }}" tabindex="-1"
                                                aria-labelledby="modalEditGuruLabel-{{ $item->NIP }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('guru.update', $item->NIP) }}" method="POST">
                                                         <i class="fa fa-edit"></i>
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Guru</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="NIP">NIP</label>
                                                                    <input type="text" name="NIP"
                                                                        class="form-control" value="{{ $item->NIP }}"
                                                                        readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="nama_guru">Nama Guru</label>
                                                                    <input type="text" name="nama_guru"
                                                                        class="form-control"
                                                                        value="{{ $item->nama_guru }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="jabatan">Jabatan</label>
                                                                    <select name="jabatan" class="form-control">
                                                                        <option value="Kepala Sekolah"
                                                                            {{ $item->jabatan == 'Kepala Sekolah' ? 'selected' : '' }}>
                                                                            Kepala Sekolah</option>
                                                                        <option value="Wali Kelas"
                                                                            {{ $item->jabatan == 'Wali Kelas' ? 'selected' : '' }}>
                                                                            Wali Kelas</option>
                                                                        <option value="Admin"
                                                                            {{ $item->jabatan == 'Admin' ? 'selected' : '' }}>
                                                                            Admin</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                                                    <input type="date" name="tgl_lahir"
                                                                        class="form-control"
                                                                        value="{{ \Carbon\Carbon::parse($item->tgl_lahir)->format('Y-m-d') }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-warning">Update</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <form action="{{ route('guru.destroy', $item->NIP) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($guru->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data guru</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
