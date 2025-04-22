@extends('layouts.app')
@section('title', 'Tahun Ajaran')

@section('content')
    <div class="row page-titles mx-0 align-items-center justify-content-between">
        <div class="col-auto">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahTA">
                <i class="fa fa-plus"></i> Tambah @yield('title')
            </button>
        </div>
        <div class="col-auto">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('tahun-ajaran.index') }}">@yield('title')</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Data Tahun Ajaran</h4>

                <!-- Modal Tambah Tahun Ajaran -->
                <div class="modal fade" id="modalTambahTA" tabindex="-1" aria-labelledby="modalTambahTALabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('tahun-ajaran.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Tahun Ajaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>ID TA</label>
                                        <input type="text" name="id_ta" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Semester</label>
                                        <input type="text" name="semester" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tahun</label>
                                        <input type="text" name="tahun" class="form-control" required>
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

                <!-- Tabel Data Tahun Ajaran -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID TA</th>
                            <th>Semester</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tahunAjaran as $ta)
                            <tr>
                                <td>{{ $ta->id_ta }}</td>
                                <td>{{ $ta->semester }}</td>
                                <td>{{ $ta->tahun }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditTA-{{ $ta->id_ta }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Modal Edit Tahun Ajaran -->
                                    <div class="modal fade" id="modalEditTA-{{ $ta->id_ta }}" tabindex="-1" aria-labelledby="modalEditTALabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('tahun-ajaran.update', $ta->id_ta) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Tahun Ajaran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>ID TA</label>
                                                            <input type="text" name="id_ta" class="form-control" value="{{ $ta->id_ta }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Semester</label>
                                                            <input type="text" name="semester" class="form-control" value="{{ $ta->semester }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Tahun</label>
                                                            <input type="text" name="tahun" class="form-control" value="{{ $ta->tahun }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-warning">Update</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('tahun-ajaran.destroy', $ta->id_ta) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data tahun ajaran</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
