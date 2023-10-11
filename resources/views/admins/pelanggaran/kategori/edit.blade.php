@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/admin/data/pelanggaran/kategori/{{ $kategori->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <h5 class="card-header text-center font-weight-bold">Edit Kategori Pelanggaran</h5><br>
                        <div class="card-body">
                            
                            <div class="mb-3">
                                <input type="text" name="name" id="name" value="{{ old('name', $kategori->name) }}" class="form-control">
                                @error('name')
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
