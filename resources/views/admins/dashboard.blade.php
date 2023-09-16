@extends('admins.layouts.main')

@section('container')
    @if (session()->has('messageLogin'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert"">
            {{ session('messageLogin') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Data Mahasiswa</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ App\Models\Mahasiswa::count() }}</h6>
                                        <span class="text-muted small pt-2 ps-1">
                                            Total Mahasiswa
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Data Dosen</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-lines-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ App\Models\Dosen::count() }}</h6>
                                        <span class="text-muted small pt-2 ps-1">
                                            Total Dosen
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Data Kelas</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ App\Models\Kelas::count() }}</h6>
                                        <span class="text-muted small pt-2 ps-1">
                                            Total Kelas
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Data SP</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-asterisk"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ App\Models\Sp::count() }}</h6>
                                        <span class="text-muted small pt-2 ps-1">
                                            Total SP
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Data Pelanggaran</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-exclamation-circle"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ App\Models\Pelanggaran::count() }}</h6>
                                        <span class="text-muted small pt-2 ps-1">
                                            Total Pelanggaran
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
