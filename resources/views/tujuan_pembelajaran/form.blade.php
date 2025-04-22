<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ $action }}" method="POST">
            @csrf
            @if ($method === 'PUT') @method('PUT') @endif
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                    @if ($method !== 'PUT')
                        <div class="mb-3">
                            <label for="id_tp">ID TP</label>
                            <input type="text" name="id_tp" class="form-control @error('id_tp') is-invalid @enderror"
                                value="{{ old('id_tp', $data->id_tp ?? '') }}" required>
                            @error('id_tp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="tujuan_pembelajaran">Tujuan Pembelajaran</label>
                        <textarea name="tujuan_pembelajaran" class="form-control @error('tujuan_pembelajaran') is-invalid @enderror" required>{{ old('tujuan_pembelajaran', $data->tujuan_pembelajaran ?? '') }}</textarea>
                        @error('tujuan_pembelajaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">{{ $method === 'PUT' ? 'Update' : 'Simpan' }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>