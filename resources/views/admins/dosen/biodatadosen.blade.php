
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
                                <div class="d-flex flex-column gap-3">
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                {!! implode('', $errors->all('<li>:message</li>')) !!}
                                            </ul>
                                        </div>
                                    @endif
                                    <img
                                        src="{{ $dosen->user->foto_user ? url('images') . '/' . $dosen->user->foto_user : 'https://identicon-server.ardyfeb.workers.dev/?hash=' . $dosen->nip }}"
                                        height="120px"
                                        width="120px"
                                        alt="Profile"
                                        class="rounded-circle align-self-center border border-warning border-2"
                                    />
                                    <form class="row g-3 mt-2" action="/admin/data/dosen/{{ $dosen->id_dosen }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-6">
                                            <label for="nip" class="form-label">NIP</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                value="{{ $dosen->nip }}"
                                                id="nip"
                                                name="nip"
                                                disabled
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nama_dosen" class="form-label">Nama Dosen</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="nama_dosen"
                                                name="nama_dosen"
                                                value="{{ old('nama_dosen', $dosen->nama_dosen) }}"
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="tempat_lahir"
                                                name="tempat_lahir"
                                                value="{{ old('tempat_lahir', $dosen->tempat_lahir) }}"
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="tgl_lahir"
                                                name="tgl_lahir"
                                                value="{{ old('tgl_lahir', $dosen->tgl_lahir) }}"
                                            >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="alamat"
                                                name="alamat"
                                                value="{{ old('alamat', $dosen->alamat) }}"
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="notelp" class="form-label">No HP</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="notelp"
                                                name="notelp"
                                                value="{{ old('notelp', $dosen->notelp) }}"
                                            />
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
