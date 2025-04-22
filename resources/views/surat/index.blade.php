@extends('layouts.app')
@section('title', 'Surat')

@section('content')
    <div class="row page-titles mx-0 align-items-center justify-content-between">
        <div class="col-auto">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahSurat">
                <i class="fa fa-plus"></i> Tambah @yield('title')
            </button>
        </div>
        <div class="col-auto">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('surat.index') }}">@yield('title')</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Data Surat Hafalan</h4>

                <!-- Modal Tambah Surat Hafalan -->
                <div class="modal fade" id="modalTambahSurat" tabindex="-1" aria-labelledby="modalTambahSuratLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('surat.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Surat Hafalan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>ID Surat</label>
                                        <input type="text" name="id_surat" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Surat</label>
                                        <input type="text" name="nama_surat" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Perkembangan</label>
                                        <select name="id_perkembangan" class="form-control" required>
                                            @foreach ($perkembangan as $perkembanganItem)
                                                <option value="{{ $perkembanganItem->id_perkembangan }}" 
                                                    @if ($item->id_perkembangan == $perkembangan->id_perkembangan) selected @endif>
                                                    {{ $perkembangan->indikator }}
                                                </option>
                                            @endforeach
                                        </select>            
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

                <!-- Tabel Surat Hafalan -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Surat</th>
                            <th>Nama Surat</th>
                            <th>Perkembangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surat as $item)
                            <tr>
                                <td>{{ $item->id_surat }}</td>
                                <td>{{ $item->nama_surat }}</td>
                                <td>{{ $item->perkembangan->indikator }}</td> <!-- Menampilkan indikator dari perkembangan -->
                                <td>
                                    <!-- Tombol Edit -->
                                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditSurat-{{ $item->id_surat }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Modal Edit Surat Hafalan -->
                                    <div class="modal fade" id="modalEditSurat-{{ $item->id_surat }}" tabindex="-1" aria-labelledby="modalEditSuratLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('surat.update', $item->id_surat) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Surat Hafalan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>ID Surat</label>
                                                            <input type="text" name="id_surat" class="form-control" value="{{ $item->id_surat }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Nama Surat</label>
                                                            <input type="text" name="nama_surat" class="form-control" value="{{ $item->nama_surat }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Perkembangan</label>
                                                            <select name="id_perkembangan" class="form-control" required>
                                                                @foreach ($perkembangan as $perkembanganItem)
                                                                    <option value="{{ $perkembanganItem->id_perkembangan }}" @if ($item->id_perkembangan == $perkembanganItem->id_perkembangan) selected @endif>
                                                                        {{ $perkembanganItem->indikator }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
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
                                    <form action="{{ route('surat.destroy', $item->id_surat) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($surat->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data Surat Hafalan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
