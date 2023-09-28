@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/pelanggaran/{{ $pelanggaran->id_pelanggaran }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Edit Data Pelanggaran</h5><br>
                        <div class="card-body">

                            <div class="mb-3">
                                <label  class="form-label" style="text-align: center;">Pelanggaran</label>
                                <input
                                    type="text"
                                    name="pelanggaran"
                                    class="form-control @error('pelanggaran') is-invalid @enderror"
                                    id="pelanggaran"
                                    value="{{ old('pelanggaran', $pelanggaran->pelanggaran) }}"
                                    autofocus
                                    placeholder="Pelanggaran"
                                >
                                @error('pelanggaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="dosen" class="form-label">Mahasiswa</label>
                                <select class="form-select @error('id_mhs') is-invalid @enderror" name="id_mhs">
                                    <option selected value="">Pilih Mahasiswa</option>
                                    @foreach($mahasiswas as $mhs)
                                        @if (old('id_mhs', $pelanggaran->id_mhs) == $pelanggaran->id_mhs)
                                            <option value="{{ $mhs->id_mhs }}" selected>{{ $mhs->nama_mhs }}</option>
                                        @else
                                            <option value="{{ $mhs->id_mhs }}">{{ $mhs->nama_mhs }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_mhs')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input
                                    type="date"
                                    name="tanggal"
                                    class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal"
                                    value="{{ old('tanggal', $pelanggaran->tanggal) }}"
                                >
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <select name="id_semester" id="semester" class="form-select">
                                    @foreach($semesters as $semester)
                                        <option value="{{ $semester->id_semester }}" @if ($pelanggaran->id_semester == $semester->id_semester || old('semester') === $semester->id_semester) selected @endif>{{ $semester->name }}</option>
                                    @endforeach
                                </select>
                                @error('semester')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control @error('deskripsi') invalid-feedback @enderror">{{ $pelanggaran->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="komdis" class="form-label">Komdis</label>
                                <select name="id_komdis" id="komdis" class="form-control">
                                    @foreach($komdis as $data)
                                    <option value="{{ $data->id_komdis }}" @if ($pelanggaran->id_komdis == $data->id_komdis || old('id_komdis') === $data->id_komdis) selected @endif>{{ $data->dosen->nama_dosen }}</option>
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
@push('reset_waktu')
<script>
    const semesterSelect = document.getElementById('semester');

    const waktuKeterlambatan = document.getElementById('waktu_keterlambatan');

    semesterSelect.addEventListener('change', function(){
        waktuKeterlambatan.value = 0;
    });
</script>
@endpush
@endsection
