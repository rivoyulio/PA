@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')
@section('container')
    <div class="pagetitle">
        <h1>History Bimbingan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ $authService->dashboardUrl() }}">Dashboard</a></li>
                <li class="breadcrumb-item active">History Mahasiswa</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg">
                <div class="row">

                    <div class="col-12">

                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">History Bimbingan Mahasiswa</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Mahasiswa</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Program Studi</th>
                                            <th>Topik Bimbingan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mahasiswas as $mahasiswa)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ url('/dosen/bimbingan?mhs_id='.$mahasiswa->id_mhs) }}" style="text-decoration: none;">
                                                        {{ $mahasiswa->nama_mhs }}
                                                    </a>
                                                </td>
                                                <td>{{ $mahasiswa->nim }}</td>
                                                <td>{{ $mahasiswa->kelas->nama_kelas }}</td>
                                                <td>{{ $mahasiswa->prodi->nama_prodi }}</td>
                                                <td rowspan="2">
                                                @foreach($mahasiswa->bimbingan as $data)
                                                    <ul>
                                                        <li>{{ $data->topic }}</li>
                                                    </ul>
                                                @endforeach
                                                </td>
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
