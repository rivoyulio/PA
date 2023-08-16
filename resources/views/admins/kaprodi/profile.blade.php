@extends('admins.layouts.main')
@section('container')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Kaprodi</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-file-earmark-person"></i> {{ $user->nama_user }}
                                </h5>
                                <div class="d-flex flex-column gap-3 flex-grow-1">
                                    <img
                                        src="{{ $user->foto_user ? url('images') . '/' . $user->foto_user : 'https://identicon-server.ardyfeb.workers.dev/?hash=' . $user->id_user }}"
                                        height="120px"
                                        width="120px"
                                        alt="Profile"
                                        class="rounded-circle align-self-center border border-warning border-2"
                                    />
                                    <form class="row g-3" method="POST" action="/admin/data/user/{{ $user->id_user }}">
                                        @csrf
                                        @method('put')
                                        <div class="col-md-12">
                                            <label for="nama_user" class="form-label">Nama</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="nama_user"
                                                name="nama_user"
                                                value="{{ old('nama_user', $user->nama_user) }}"
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="email"
                                                name="email"
                                                value="{{ old('email', $user->email) }}"
                                                disabled
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nama_user" class="form-label">Password</label>
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="password"
                                                name="password"
                                                placeholder="Kosongkan jika tidak ingin mengubah password"
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
