@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/sp" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Tambah SP</h5><br>
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="text-align: center;">SP</label>
                                <input
                                    type="text"
                                    name="sp_name"
                                    class="form-control @error('sp_name') is-invalid @enderror"
                                    id="sp_name"
                                    value="{{ old('sp_name') }}"
                                    autofocus
                                    placeholder="Nama SP"
                                >
                                @error('sp_name')
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
