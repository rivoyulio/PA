@extends('admins.layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/kaprodi') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">{{ $title }}</li>
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
                                <h5 class="card-title">{{ $title }}</h5>
                                <a href="{{ url()->current() }}/print" target="_blank" type="button" class="btn btn-primary btn-sm mb-4">
                                    Print
                                </a>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIP</th>
                                            <th scope="col">Nama Dosen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mahasiswa as $mhs)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $mhs->nama_mhs }}</td>
                                                <td>{{ $mhs->kelas->dosen->nama_dosen }}</td>
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
