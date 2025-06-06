@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">Input Siswa ke Kelas</h3>

    <form method="POST" action="{{ route('anggota_kelas.store') }}">
        @csrf

        <div class="mb-4">
            <label for="id_wakel" class="form-label">Pilih Wali Kelas</label>
            <select name="id_wakel" id="id_wakel" class="form-control" required>
                <option value="">-- Pilih Wali Kelas --</option>
                @foreach ($waliKelasList as $wk)
                    <option value="{{ $wk->id_wakel }}">{{ $wk->guru->nama_guru }} ({{ $wk->tahunAjaran->tahun_mulai }} - Semester {{ $wk->tahunAjaran->semester }})</option>
                @endforeach
            </select>
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th><input type="checkbox" onclick="toggleAll(this)"></th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswaList as $siswa)
                        <tr>
                            <td>
                                <input type="checkbox" name="siswa_ids[]" value="{{ $siswa->NIS }}">
                            </td>
                            <td>{{ $siswa->NIS }}</td>
                            <td>{{ $siswa->nama_siswa }}</td>
                            <td>
                                @php
                                    $sebelumnya = $anggotaSebelumnya[$siswa->NIS][0] ?? null;
                                @endphp
                                {{ $sebelumnya ? 'Kelas ' . $sebelumnya->waliKelas->kelas->nama_kelas : 'Kelas -' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('anggota_kelas.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>

{{-- Optional: Script untuk checkbox semua --}}
<script>
    function toggleAll(source) {
        checkboxes = document.getElementsByName('siswa_ids[]');
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>
@endsection
