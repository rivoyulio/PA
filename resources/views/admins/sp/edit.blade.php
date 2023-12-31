@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/sp/{{ $sp->id_sp }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Edit SP</h5><br>
                        <div class="card-body">
                            
                            <div class="mb-3">
                                <label for="dosen" class="form-label">Mahasiswa</label>
                                <select class="form-select @error('id_mhs') is-invalid @enderror" name="id_mhs">
                                    <option selected value="{{ $sp->id_mhs }}">{{ $sp->mahasiswa->nama_mhs }}</option>
                                </select>
                                @error('id_mhs')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <select name="id_semester" id="semester" class="form-select">
                                    @foreach($semesters as $semester)
                                        <option value="{{ $semester->id_semester }}" @if ($sp->id_semester == $semester->id_semester || old('semester') === $semester->id_semester) selected @endif>{{ $semester->name }}</option>
                                    @endforeach
                                </select>
                                @error('semester')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="waktu_existing" class="form-label">Jam Alfa Saat Ini</label>
                                <input type="text" value="{{ old('alfa', $sp->alfa) }}" class="form-control" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="alfa" class="form-label">Tambahan Jam Alfa</label>
                                <input
                                    type="number"
                                    name="alfa"
                                    class="form-control @error('alfa') is-invalid @enderror"
                                    id="alfa"
                                    value="0"
                                >
                                @error('alfa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
@push('reset_waktu')
<script>
    const semesterSelect = document.getElementById('semester');

    const waktuKeterlambatan = document.getElementById('alfa');

    semesterSelect.addEventListener('change', function(){
        waktuKeterlambatan.value = 0;
    });
</script>
@endpush
@endsection
