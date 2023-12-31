@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')
@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert"">
            Data Berhasil di Tambah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('pesan_edit'))
        <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert"">
            Data Berhasil di Edit
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('pesan_hapus'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert"">
            Data Berhasil di Hapus
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="pagetitle">
        <h1>Kelas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ $authService->dashboardUrl() }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Kelas</li>
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
                        <a href="/admin/data/kelas/create" type="button" class="btn btn-primary btn-sm mb-4">+ Tambah Kelas</a>
                        <div class="card recent-sales overflow-auto">
                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}

                            <div class="card-body">
                                <h5 class="card-title">Kelas</h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Kelas</th>
                                            <th scope="col">Program Studi</th>
                                            <th scope="col">Nama Dosen</th>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelass as $kelas)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="{{ url('/admin/data/kelas/'.$kelas->id_kelas) }}" style="text-decoration: none;">{{ $kelas->nama_kelas }}</a></td>
                                                <td>{{ $kelas->prodi->nama_prodi }}</td>
                                                <td>{{ $kelas->dosen->nama_dosen }}</td>
                                                <td>{{ $kelas->tahun_angkatan }}</td>
                                                <td>{{ $kelas->jumlah }}</td>
                                                <td>
                                                    <a href="{{ url('/admin/data/kelas/' . $kelas->id_kelas . '/edit/') }}" class="btn btn-link">
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="bi bi-info-circle"></i> Edit
                                                        </span>
                                                    </a>
                                                    <form action="{{ '/admin/data/kelas/' . $kelas->id_kelas }}" method="POST">
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

                    {{-- {{ $kelass->links() }} --}}
                </div>
            </div><!-- End Left side columns -->


        </div>
    </section>

@endsection
