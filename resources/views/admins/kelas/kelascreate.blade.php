@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/kelas/kelasdetail" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Tambah Mahasiswa</h5><br>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Kelas</label>
                                <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas" value="{{ old('nama_kelas') }}" autofocus placeholder="Nama Kelas">
                                @error('nama_kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prodi" class="form-label">Prodi</label>
                                    <select class="form-select" name="id_prodi" aria-label="Default select example">
                                        <option selected></option>
                                        @foreach($prodis as $prodi)
                                            @if (old('id_prodi') == $prodi->id_prodi)
                                                <option value="{{ $prodi->id_prodi }}" selected>{{ $prodi->nama_prodi }}</option>
                                            @else
                                                <option value="{{ $prodi->id_prodi }}">{{ $prodi->nama_prodi }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dosen" class="form-label">Dosen</label>
                                    <select class="form-select" name="id_dosen" aria-label="Default select example">
                                        <option selected></option>
                                        @foreach($dosens as $dosen)
                                            @if (old('id_dosen') == $dosen->id_dosen)
                                                <option value="{{ $dosen->id_dosen }}" selected>{{ $dosen->nama_dosen }}</option>
                                            @else
                                                <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama_dosen }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Tahun Angkatan</label>
                                <input type="text" name="tahun_angkatan" class="form-control @error('tahun_angkatan') is-invalid @enderror" id="tahun_angkatan" value="{{ old('tahun_angkatan') }}" autofocus placeholder="Tahun Angkatan">
                                @error('tahun_angkatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Jumlah</label>
                                <input type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" value="{{ old('jumlah') }}" autofocus placeholder="Jumlah Mahasiswa">
                                @error('jumlah')
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
    <br>
@endsection
