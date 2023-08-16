@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/admin/data/mahasiswa/{{ $data->id_mhs }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Edit Data Mahasiswa</h5><br>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">NIM</label>
                                <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" id="nim" value="{{old('nim',$data->nim)}}" autofocus placeholder="NIM">
                                @error('nim')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Mahasiswa</label>
                                <input type="text" name="nama_mhs" class="form-control @error('nama_mhs') is-invalid @enderror" id="nama_mhs" value="{{old('nama_mhs',$data->nama_mhs)}}" autofocus placeholder="Nama Mahasiswa">
                                @error('nama_mhs')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                @if ($data->fotomhs)
                                    <img style="max-width: 250px" src="{{ url('images').'/'.$data->fotomhs }}" alt="{{ $data->nama_foto }}"
                                        class="img-thumbnail img-preview">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Foto User</label>
                                <input type="file" class="form-control @error('fotomhs') is-invalid @enderror" id="fotomhs"
                                    name="fotomhs" value="{{ old('fotomhs') }}" autofocus>
                                @error('fotomhs')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label" style="text-align: center;">Password</label>
                                <input
                                    type="text"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    placeholder="Kosongkan jika tidak ingin mengubah password"
                                />
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prodi" class="form-label">Prodi</label>
                                        <select class="form-select" name="id_prodi" aria-label="Default select example">
                                            <option selected></option>
                                            @foreach(\App\Models\Prodi::all() as $prodi)
                                                @if (old('id_prodi',$data->id_prodi) == $prodi->id_prodi)
                                                    <option value="{{ $prodi->id_prodi }}" selected>{{ $prodi->nama_prodi.'-'. $prodi->jenjang }}</option>
                                                @else
                                                    <option value="{{ $prodi->id_prodi }}">{{ $prodi->nama_prodi.'-'. $prodi->jenjang }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kelas" class="form-label">Kelas</label>
                                        <select class="form-select" name="id_kelas" aria-label="Default select example">
                                            <option selected></option>
                                            @foreach(\App\Models\Kelas::all() as $kelas)
                                                @if (old('id_kelas',$data->id_kelas) == $kelas->id_kelas)
                                                    <option value="{{ $kelas->id_kelas }}" selected>{{ $kelas->nama_kelas }}</option>
                                                @else
                                                    <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
