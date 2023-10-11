@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="{{ route('komdis.update', $komdis->id_komdis) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Edit Data Komdis</h5><br>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="komdis" class="form-label">Komdis</label>
                                <select name="id_dosen" id="dosen" class="form-control @error('id_komdis') is-invalid @enderror" data-live-search="true">
                                    @foreach($dosen as $data)
                                    <option value="{{ $data->id_dosen }}" @if ($komdis->id_dosen == $data->id_dosen || old('id_dosen') === $data->id_dosen) selected @endif>{{ $data->nama_dosen }}</option>
                                    @endforeach 
                                </select>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@push('select-picker')
<script>
$(function () {
    $('dosen').selectpicker();
});
</script>
@endpush
@endsection