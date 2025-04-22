@extends('layouts.app')
@section('title', 'Data Fase')

@section('content')
    <div class="row page-titles mx-0 align-items-center justify-content-between">
        <div class="col-auto">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahFase">
                <i class="fa fa-plus"></i> Tambah @yield('title')
            </button>
        </div>
        <div class="col-auto">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('fase.index') }}">@yield('title')</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Data Fase</h4>

                        <!-- Modal Tambah Fase -->
                        <div class="modal fade" id="modalTambahFase" tabindex="-1" aria-labelledby="modalTambahFaseLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('fase.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahFaseLabel">Tambah Fase</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="id_fase">ID Fase</label>
                                                <input type="text" name="id_fase"
                                                    class="form-control @error('id_fase') is-invalid @enderror"
                                                    value="{{ old('id_fase') }}" required>
                                                @error('id_fase')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_fase">Nama Fase</label>
                                                <input type="text" name="nama_fase"
                                                    class="form-control @error('nama_fase') is-invalid @enderror"
                                                    value="{{ old('nama_fase') }}" required>
                                                @error('nama_fase')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Tabel Data -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Fase</th>
                                    <th>Nama Fase</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fase as $item)
                                    <tr>
                                        <td>{{ $item->id_fase }}</td>
                                        <td>{{ $item->nama_fase }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEditFase-{{ $item->id_fase }}">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <!-- Modal Edit Fase -->
                                            <div class="modal fade" id="modalEditFase-{{ $item->id_fase }}"
                                                tabindex="-1" aria-labelledby="modalEditFaseLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('fase.update', $item->id_fase) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Fase</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal">X</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="id_fase">ID Fase</label>
                                                                    <input type="text" name="id_fase"
                                                                        class="form-control"
                                                                        value="{{ $item->id_fase }}" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="nama_fase">Nama Fase</label>
                                                                    <input type="text" name="nama_fase"
                                                                        class="form-control"
                                                                        value="{{ $item->nama_fase }}" required>
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
                                            <form action="{{ route('fase.destroy', $item->id_fase) }}" method="POST"
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

                                @if ($fase->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada data fase</td>
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
