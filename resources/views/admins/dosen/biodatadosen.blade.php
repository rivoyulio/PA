
@extends('admins.layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-file-earmark-person"></i> {{ $dosen->nama_dosen }}
                                </h5>
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nip" class="form-label">
                                            NIP
                                        </label>
                                        <input type="text" class="form-control" disabled id="nip" value="{{ $dosen->nip }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_dosen" class="form-label">
                                            Nama Dosen
                                        </label>
                                        <input type="text" class="form-control" disabled id="nama_dosen" value="{{ $dosen->nama_dosen }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tempat_lahir" class="form-label">
                                            Tempat Lahir
                                        </label>
                                        <input type="text" class="form-control" disabled id="tempat_lahir" value="{{ $dosen->tempat_lahir }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl_lahir" class="form-label">
                                            Tanggal Lahir
                                        </label>
                                        <input type="text" class="form-control" disabled id="tgl_lahir" value="{{ $dosen->tgl_lahir }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="alamat" class="form-label">
                                            Alamat
                                        </label>
                                        <input type="text" class="form-control" disabled id="alamat" value="{{ $dosen->alamat }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="notelp" class="form-label">
                                            No HP
                                        </label>
                                        <input type="text" class="form-control" disabled id="notelp" value="{{ $dosen->notelp }}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
