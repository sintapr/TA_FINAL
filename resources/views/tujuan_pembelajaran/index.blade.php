@extends('layouts.app')
@section('title', 'Tujuan Pembelajaran')

@section('content')
<div class="row page-titles mx-0 align-items-center justify-content-between">
    <div class="col-auto">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="fa fa-plus"></i> Tambah @yield('title')
        </button>
    </div>
    <div class="col-auto">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('tujuan.index') }}">@yield('title')</a></li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4>Data Tujuan Pembelajaran</h4>

            {{-- Modal Tambah --}}
            @include('tujuan_pembelajaran.form', ['action' => route('tujuan.store'), 'method' => 'POST', 'modalId' => 'modalTambah', 'title' => 'Tambah Tujuan Pembelajaran'])

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID TP</th>
                        <th>Tujuan Pembelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tujuan as $item)
                        <tr>
                            <td>{{ $item->id_tp }}</td>
                            <td>{{ $item->tujuan_pembelajaran }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit-{{ $item->id_tp }}">
                                    <i class="fa fa-edit"></i>
                                </a>

                                {{-- Modal Edit --}}
                                @include('tujuan_pembelajaran.form', [
                                    'action' => route('tujuan.update', $item->id_tp),
                                    'method' => 'PUT',
                                    'modalId' => 'modalEdit-' . $item->id_tp,
                                    'title' => 'Edit Tujuan Pembelajaran',
                                    'data' => $item
                                ])

                                <!-- Tombol Hapus -->
                                <form action="{{ route('tujuan.destroy', $item->id_tp) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                            <td colspan="3" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
