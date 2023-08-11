@extends('admins.layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Kelas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/data/kelas') }}" >Kelas</a></li>
                <li class="breadcrumb-item active">Data Kelas</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg">
                <div class="row">
                    <div class="col-12">
                        <a href="/admin/data/mahasiswa/create" type="button" class="btn btn-primary btn-sm mb-4">
                            + Tambah Mahasiswa
                        </a>
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Data Kelas {{ $kelas->nama_kelas }}</h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Nama Mahasiswa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelas->mahasiswa as $mhs)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $mhs->nim }}</td>
                                                <td>{{ $mhs->nama_mhs }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
