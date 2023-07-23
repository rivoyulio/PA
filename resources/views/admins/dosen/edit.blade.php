@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/dosen/{{ $data->id_dosen }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Edit Data Dosen</h5><br>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Id User</label>
                                <input type="text" name="id_user" class="form-control @error('id_user') is-invalid @enderror" id="id_user" value="{{ old('id_user',$data->id_user )}}" autofocus placeholder="Id User">
                                @error('id_user')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">NIP</label>
                                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip" value="{{ old('nip',$data->nip )}}" autofocus placeholder="NIP">
                                @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Dosen</label>
                                <input type="text" name="nama_dosen" class="form-control @error('nama_dosen') is-invalid @enderror" id="nama_dosen" value="{{ old('nama_dosen',$data->nama_dosen )}}" autofocus placeholder="Nama Dosen">
                                @error('nama_dosen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" value="{{ old('jabatan',$data->jabatan )}}" autofocus placeholder="Jabatan">
                                @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ old('tempat_lahir',$data->tempat_lahir )}}" autofocus placeholder="Tempat Lahir">
                                @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" value="{{ old('tgl_lahir',$data->tgl_lahir )}}" autofocus placeholder="Tanggal Lahir">
                                @error('tgl_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Alamat</label>
                                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ old('alamat',$data->alamat )}}" autofocus placeholder="Alamat">
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">No Telepon</label>
                                <input type="text" name="notelp" class="form-control @error('notelp') is-invalid @enderror" id="notelp" value="{{ old('notelp',$data->notelp )}}" autofocus placeholder="No Telepon">
                                @error('notelp')
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
