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
                <li class="breadcrumb-item">
                    <a href="{{ $authService->dashboardUrl() }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Data Dosen Komdis</li>
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
                        <a href="/komdis/create" type="button" class="btn btn-primary btn-sm mb-4">+ Tambah Dosen Komdis</a>
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Dosen Komdis</h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Dosen Komdis</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($komdiss as $komdis)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $komdis->nama_komdis }}</td>
                                                <td>
                                                    <a href="{{ url('/komdis/' . $komdis->id_komdis . '/edit/') }}" class="btn btn-link">
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="bi bi-info-circle"></i> Edit
                                                        </span>
                                                    </a>
                                                    <form action="{{ '/komdis/' . $komdis->id_komdis }}" method="POST" style="display: inline">
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
