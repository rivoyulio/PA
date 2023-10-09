@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/pelanggaran" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Buat Data Pelanggaran</h5><br>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="pelanggaran" class="form-label" style="text-align: center;">Pelanggaran</label>
                                <select name="id_kategori" id="kategori" class="form-control">
                                    @foreach($kategori as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('pelanggaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="dosen" class="form-label">Mahasiswa</label>
                                <select class="form-select @error('id_mhs') is-invalid @enderror" name="id_mhs" aria-label="Default select example">
                                    <option selected value="">Pilih Mahasiswa</option>
                                    @foreach($mahasiswas as $mhs)
                                        @if (old('id_mhs') == $mhs->id_mhs)
                                            <option value="{{ $mhs->id_mhs }}" selected>{{ $mhs->nama_mhs }}</option>
                                        @else
                                            <option value="{{ $mhs->id_mhs }}">{{ $mhs->nama_mhs }}-{{ $mhs->nim }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_mhs')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- <div class="mb-3">
                                <label for="surat" class="form-label">Surat SP</label>
                                <input
                                    type="file"
                                    name="surat"
                                    class="form-control @error('surat') is-invalid @enderror"
                                    id="surat"
                                    value="{{ old('surat') }}"
                                >
                                @error('surat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> -->

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input
                                    type="date"
                                    name="tanggal"
                                    class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal"
                                >
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_semester" class="form-label">Semester</label>
                                <select name="id_semester" id="id_semester" class="form-select @error('id_semester') is-invalid @enderror">
                                    @foreach($semesters as $semester)
                                    <option value="{{ $semester->id_semester }}">{{ $semester->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_semester')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea
                                    name="deskripsi"
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    id="deskripsi"
                                    value="{{ old('deskripsi') }}"
                                    rows="3"
                                ></textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="komdis" class="form-label">Komdis</label>
                                <select name="id_komdis" id="komdis" class="form-control @error('id_komdis') is-invalid @enderror">
                                    @foreach($komdis as $data)
                                        <option value="{{ $data->id_komdis }}">{{ $data->dosen->nama_dosen }}</option>
                                    @endforeach
                                </select>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <input type="hidden" name="status" value="baik">

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
    </div>
    <br>
@endsection
