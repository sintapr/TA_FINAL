@extends('layouts.app')
@section('title', 'Data Kelas')

@section('content')
    <div class="row page-titles mx-0 align-items-center justify-content-between">
        <div class="col-auto">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahKelas">
                <i class="fa fa-plus"></i> Tambah @yield('title')
            </button>
        </div>
        <div class="col-auto">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('kelas.index') }}">@yield('title')</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Data Kelas</h4>
                        <!-- Modal Tambah Kelas -->
                        <div class="modal fade" id="modalTambahKelas" tabindex="-1" aria-labelledby="modalTambahKelasLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('kelas.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahKelasLabel">Tambah Kelas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">X</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="id_kelas">Id Kelas</label>
                                                <input type="text" name="id_kelas"
                                                    class="form-control @error('id_kelas') is-invalid @enderror"
                                                    value="{{ old('id_kelas') }}" required>
                                                @error('id_kelas')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama_kelas">Nama Kelas</label>
                                                <input type="text" name="nama_kelas"
                                                    class="form-control @error('nama_kelas') is-invalid @enderror"
                                                    value="{{ old('nama_kelas') }}" required>
                                                @error('nama_kelas')
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
                        <!-- Tabel Data -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id Kelas</th>
                                    <th>Nama Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $item)
                                    <tr>
                                        <td>{{ $item->id_kelas }}</td>
                                        <td>{{ $item->nama_kelas }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEditKelas-{{ $item->id_kelas }}">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <!-- Modal Edit Kelas -->
                                            <div class="modal fade" id="modalEditKelas-{{ $item->id_kelas }}"
                                                tabindex="-1" aria-labelledby="modalEditKelasLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('kelas.update', $item->id_kelas) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Kelas</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal">X</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="id_kelas">Id Kelas</label>
                                                                    <input type="text" name="id_kelas"
                                                                        class="form-control" value="{{ $item->id_kelas }}"
                                                                        readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="nama_kelas">Nama Kelas</label>
                                                                    <input type="text" name="nama_kelas"
                                                                        class="form-control"
                                                                        value="{{ $item->nama_kelas }}" required>
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

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('kelas.destroy', $item->id_kelas) }}" method="POST"
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

                                @if ($kelas->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada data kelas</td>
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
