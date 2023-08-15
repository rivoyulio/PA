@extends('admins.layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Detail Bimbingan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Detail Mahasiswa</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg">
                <div class="row">

                    <!-- Recent Sales -->
                    <div class="col-12">

                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Detail Bimbingan Mahasiswa</h5>
                                <a target="_blank" href="/mahasiswa/bimbingan/cetak" class="btn btn-success">
                                    <i class="bi bi-file-earmark-break-fill"></i> Cetak Detail Bimbingan
                                </a>

                                <br>
                                <br>

                                <h6>Nama Dosen: {{ $mahasiswa->kelas->dosen->nama_dosen }}</h6><br>
                                <h6>Nama Mahasiswa : {{ $mahasiswa->nama_mhs }}</h6><br>
                                <h6>NIM : {{ $mahasiswa->nim }}</h6><br>
                                <h6>Kelas : {{ $mahasiswa->kelas->nama_kelas }}</h6><br>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal Bimbingan</th>
                                            <th scope="col">Bimbingan</th>
                                            <th scope="col">Permasalahan Mahasiswa</th>
                                            <th scope="col">Solusi Dosen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bimbingans as $bimbingan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $bimbingan->tanggal_bimbingan }}</td>
                                                <td>{{ $bimbingan->bimbingan }}</td>
                                                <td>{{ $bimbingan->pesan_mhs }}</td>
                                                <td>{{ $bimbingan->pesan_dosen }}</td>
                                                <td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                </div>
            </div><!-- End Left side columns -->


        </div>
    </section>

@endsection
