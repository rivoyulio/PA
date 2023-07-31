@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/prodi" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Tambah Prodi</h5><br>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Kode Prodi</label>
                                <input type="text" name="kode_prodi" class="form-control @error('kode_prodi') is-invalid @enderror" id="kode_prodi" value="{{ old('kode_prodi') }}" autofocus placeholder="Kode Prodi">
                                @error('kode_prodi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Prodi</label>
                                <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror" id="nama_prodi" value="{{ old('nama_prodi') }}" autofocus placeholder="Nama Prodi">
                                @error('nama_prodi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Jenjang</label>
                                <input type="text" name="jenjang" class="form-control @error('jenjang') is-invalid @enderror" id="jenjang" value="{{ old('jenjang') }}" autofocus placeholder="Jenjang">
                                @error('jenjang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="prodi" class="form-label">Ketua Prodi</label>
                                <select class="form-select @error('id_sp') is-invalid @enderror" name="id_user">
                                    <option selected value="">Pilih User</option>
                                    @foreach($users as $user)
                                        @if (old('id_user') == $user->id_user)
                                            <option value="{{ $user->id_user }}" selected>{{ $user->nama_user }}</option>
                                        @else
                                            <option value="{{ $user->id_user }}">{{ $user->nama_user }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_user')
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
