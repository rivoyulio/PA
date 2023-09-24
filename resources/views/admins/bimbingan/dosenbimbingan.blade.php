@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')
@section('container')
@php
    use Illuminate\Support\Str;
@endphp
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert"">
            {{ session('success')}} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="pagetitle">
        <h1>Bimbingan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ $authService->dashboardUrl() }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Bimbingan</li>
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
                                <h5 class="card-title">Bimbingan Mahasiswa</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Mahasiswa</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Tanggal Bimbingan</th>
                                            <th scope="col">Bimbingan</th>
                                            <th scope="col">Topik</th>
                                            <th scope="col">Permasalahan Mahasiswa</th>
                                            <th scope="col">Dokumen</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bimbingans as $bimbingan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $bimbingan->mahasiswa->nama_mhs}}</td>
                                                <td>{{ $bimbingan->mahasiswa->nim }}</td>
                                                <td>{{ $bimbingan->tanggal_bimbingan }}</td>
                                                <td>{{ $bimbingan->bimbingan }}</td>
                                                <td>{{ $bimbingan->topic }}</td>
                                                <td>{{ $bimbingan->pesan_mhs }}</td>
                                                <td>
                                                    <a href="{{ Storage::url($bimbingan->file) }}" target="_blank" class="card p-2 rounded">{{ \Illuminate\Support\Str::afterLast($bimbingan->file, '/') }}</a>
                                                </td>
                                                <td>
                                                    <!-- <a href="{{ url('/bimbingan/' . $bimbingan->id_bimbingan) }}" class="btn btn-link">
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="bi bi-info-circle"></i> Edit
                                                        </span>
                                                    </a> -->
                                                    <a href="{{ url('/bimbingan/' . $bimbingan->id_bimbingan) }}" class="btn btn-link">
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-info-circle"></i> Detail</span>
                                                    </a>
                                                    <form action="{{ '/bimbingan/' . $bimbingan->id_bimbingan }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" id="#delete" class="btn btn-link">
                                                            <span class="badge bg-danger text-dark">
                                                                <i class="bi bi-trash"></i> Hapus
                                                            </span>
                                                        </button>
                                                    </form>
                                                </td>
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
