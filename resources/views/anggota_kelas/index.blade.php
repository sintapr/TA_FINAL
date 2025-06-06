@extends('layouts.app')
@section('title', 'Manajemen Anggota Kelas')

@section('content')
    <div class="row page-titles mx-0 align-items-center justify-content-between mb-3">
        <div class="col-auto">
            <h4 class="mb-0">@yield('title')</h4>
        </div>
        <div class="col-auto">
            <a href="{{ route('anggota_kelas.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Input Siswa ke Kelas
            </a>
        </div>
    </div>

    <form method="GET" action="{{ route('anggota_kelas.index') }}" class="card p-3 mb-4 shadow-sm">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="id_ta" class="form-label">Filter Tahun Ajaran</label>
                <select name="id_ta" id="id_ta" class="form-select" onchange="this.form.submit()">
                    @foreach ($tahunAjaranList as $ta)
                        <option value="{{ $ta->id_ta }}" {{ $id_ta == $ta->id_ta ? 'selected' : '' }}>
                            {{ $ta->tahun_mulai }} - Semester {{ ucfirst($ta->semester) }} {{ $ta->status ? '(Aktif)' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Tahun Ajaran</th>
                            <th>Wali Kelas</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($anggotaKelas as $item)
                            <tr>
                                <td>{{ $item->siswa->NIS }}</td>
                                <td>{{ $item->siswa->nama_siswa }}</td>
                                <td>
                                    <span class="badge bg-info text-white">
                                        {{ $item->waliKelas->tahunAjaran->tahun_mulai }} - Semester {{ ucfirst($item->waliKelas->tahunAjaran->semester) }}
                                    </span>
                                </td>
                                <td>{{ $item->waliKelas->guru->nama_guru ?? '-' }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('anggota_kelas.destroy', $item->id_anggota) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus siswa dari kelas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada anggota kelas untuk tahun ajaran ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
