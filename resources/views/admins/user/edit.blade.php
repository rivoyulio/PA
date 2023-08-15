@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/admin/data/user/{{ $data->id_user }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Edit Data User</h5><br>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama User</label>
                                <input type="text" name="nama_user" class="form-control @error('nama_user') is-invalid @enderror" id="nama_user" value="{{old('nama_user',$data->nama_user)}}" autofocus placeholder="Nama User">
                                @error('nama_user')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email',$data->email)}}" autofocus placeholder="Email">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label" style="text-align: center;">Password</label>
                                <input
                                    type="text"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Kosongkan jika tidak mengubah password"
                                />
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Level User</label>
                                <input type="text" name="level" class="form-control @error('level') is-invalid @enderror" id="level" value="{{old('level',$data->level)}}" autofocus placeholder="Level User">
                                @error('level')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                @if ($data->foto_user)
                                    <img style="max-width: 250px" src="{{ url('images').'/'.$data->foto_user }}" alt="{{ $data->nama_foto }}"
                                        class="img-thumbnail img-preview">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Foto User</label>
                                <input type="file" class="form-control @error('foto_user') is-invalid @enderror" id="foto_user"
                                    name="foto_user" value="{{ old('foto_user') }}" autofocus>
                                @error('foto_user')
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
