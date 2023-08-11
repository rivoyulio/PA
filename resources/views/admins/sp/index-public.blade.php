@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')
@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert"">
            {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="pagetitle">
        <h1>SP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Data SP</li>
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
                                <h5 class="card-title">SP</h5>
                                @if($authService->currentUserIsKaprodi())
                                    <a href="/sp/print" target="_blank" type="button" class="btn btn-primary btn-sm mb-4">Print</a>
                                @endif

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">SP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pelanggaran as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p->mahasiswa->nama_mhs }}</td>
                                                <td>{{ $p->mahasiswa->nim }}</td>
                                                <td>{{ $p->mahasiswa->kelas->nama_kelas }}</td>
                                                <td>{{ $p->sp->nama_sp }}</td>
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
