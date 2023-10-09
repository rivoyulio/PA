@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')
@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert"">
            {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="pagetitle">
        <h1>Kategori Pelanggaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ $authService->dashboardUrl() }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Kategori Pelanggaran</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg">
                <div class="row">

                    <div class="col-12">
                        <a href="{{ route('kategori.create') }}" type="button" class="btn btn-primary btn-sm mb-4">+ Tambah Kategori</a>
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Kategori Pelanggaran</h5>
                                
                                <table class="table table-borderless mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategori as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>
                                                    <a href="{{ url('/admin/data/pelanggaran/kategori/' . $data->id . '/edit/') }}" class="btn btn-link">
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="bi bi-info-circle"></i> Edit
                                                        </span>
                                                    </a>
                                                    <form action="{{ '/admin/data/pelanggaran/kategori/' . $data->id }}" method="POST" style="display: inline;">
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
