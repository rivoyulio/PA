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
                        <form action="/bimbingan/{{ $bimbingan->id_bimbingan }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            @php($is_dosen = $authService->currentUserIsDosen())
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Edit Bimbingan Mahasiswa</h5>
                                    <input type="hidden" id="id_mhs" name="id_mhs" value="{{ $bimbingan->mahasiswa->id_mhs }}" />
                                    <div class="mb-3">
                                        <label for="tanggal_bimbingan" class="form-label">Tanggal Bimbingan</label>
                                        <input
                                            type="date"
                                            name="tanggal_bimbingan"
                                            class="form-control @error('tanggal_bimbingan') is-invalid @enderror"
                                            id="tanggal_bimbingan"
                                            value="{{ old('tanggal_bimbingan', $bimbingan->tanggal_bimbingan) }}"
                                            {{ $is_dosen ? 'readonly' : '' }}
                                        />
                                        @error('tanggal_bimbingan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="bimbingan" class="form-label">Bimbingan</label>
                                        <textarea class="form-control @error('pesan_mhs') is-invalid @enderror" name="bimbingan" id="bimbingan" rows="4" {{ $is_dosen ? 'readonly' : '' }}>{{ old('bimbingan', $bimbingan->bimbingan) }}</textarea>
                                        @error('bimbingan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="pesan_mhs" class="form-label">Permasalahan Mahasiswa</label>
                                        <textarea class="form-control @error('pesan_mhs') is-invalid @enderror" name="pesan_mhs" id="pesan_mhs" rows="4" {{ $is_dosen ? 'readonly' : '' }}>{{ old('pesan_mhs', $bimbingan->pesan_mhs) }}</textarea>
                                        @error('pesan_mhs')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="pesan_dosen" class="form-label">Solusi Dosen</label>
                                        <textarea class="form-control @error('pesan_dosen') is-invalid @enderror" name="pesan_dosen" id="pesan_dosen" rows="4">{{ old('pesan_dosen', $bimbingan->pesan_dosen) }}</textarea>
                                        @error('pesan_dosen')
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
