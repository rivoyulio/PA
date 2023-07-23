@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/agama" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Tambah Agama</h5><br>
                        <div class="mb-3">
                            <div class="card-body">
                                {{-- <div class="mb-3">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>Silahkan Pilih Salah Satu</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div> --}}
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Agama</label>
                                <input type="text" name="agama" class="form-control @error('agama') is-invalid @enderror" id="agama" value="{{ old('agama') }}" autofocus placeholder="Agama">
                                @error('agama')
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
