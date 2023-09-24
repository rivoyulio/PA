@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')
@section('container')
    <div class="pagetitle">
        <h1>Bimbingan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ $authService->dashboardUrl() }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Bimbingan</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg">
                <div class="row">
                    <div class="col-12">
                        <form action="/bimbingan" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Bimbingan Mahasiswa</h5>
                                    <div class="mb-3">
                                        <label for="nama_mhs" class="form-label">Nama Mahasiswa</label>
                                        <input type="text" name="nama_mhs" class="form-control"  value="{{ $mahasiswa->nama_mhs }}" disabled />
                                        <input type="hidden" id="id_mhs" name="id_mhs" value="{{ $mahasiswa->id_mhs }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_dosen" class="form-label">Nama Dosen</label>
                                        <input type="text" name="nama_dosen" class="form-control" id="nama_dosen" value="{{ $mahasiswa->kelas->dosen->nama_dosen }}" disabled />
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_bimbingan" class="form-label">Tanggal Bimbingan</label>
                                        <input
                                            type="date"
                                            name="tanggal_bimbingan"
                                            class="form-control @error('tanggal_bimbingan') is-invalid @enderror"
                                            id="tanggal_bimbingan"
                                            value="{{ old('tanggal_bimbingan') }}"
                                        >
                                        @error('tanggal_bimbingan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="topic" class="form-label">Topik Bimbingan</label>
                                        <input type="text" class="form-control @error('topic') is-invalid @enderror" name="topic" id="topic" value="{{ old('topic') }}">
                                        @error('topic')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="bimbingan" class="form-label">Bimbingan</label>
                                        <textarea class="form-control @error('pesan_mhs') is-invalid @enderror" name="bimbingan" id="bimbingan" rows="4">{{ old('bimbingan')  }}</textarea>
                                        @error('bimbingan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="pesan_mhs" class="form-label">Permasalahan Mahasiswa</label>
                                        <textarea class="form-control @error('pesan_mhs') is-invalid @enderror" name="pesan_mhs" id="pesan_mhs" rows="4">{{ old('pesan_mhs') }}</textarea>
                                        @error('pesan_mhs')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Upload File Pendukung</label>
                                        <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                                        @error('file')
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
        </div>
    </section>

@endsection
