@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/pelanggaran/{{ $pelanggaran->id_pelanggaran }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Edit Data Kelas</h5><br>
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="prodi" class="form-label">SP</label>
                                <select class="form-select @error('id_sp') is-invalid @enderror" name="id_sp">
                                    <option selected value="">Pilih SP</option>
                                    @foreach($sps as $sp)
                                        @if (old('id_sp', $pelanggaran->id_sp) == $sp->id_sp)
                                            <option value="{{ $sp->id_sp }}" selected>{{ $sp->nama_sp }}</option>
                                        @else
                                            <option value="{{ $sp->id_sp }}">{{ $sp->nama_sp }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_sp')
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

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
