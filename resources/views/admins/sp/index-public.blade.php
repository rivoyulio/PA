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
                <li class="breadcrumb-item"><a href="{{ $authService->dashboardUrl() }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Data SP</li>
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
                                <h5 class="card-title">SP</h5>
                                <form method="GET">
                                    <div class="d-flex flex-row align-items-center">
                                        <div class="d-flex flex-fill gap-2 align-items-center">
                                            <div class="d-flex gap-1">
                                                <select class="form-select form-select-sm" name="tahun" id="tahun">
                                                    <option selected value="">Pilih Tahun</option>
                                                    @foreach ($tahun_list as $t)
                                                        <option value="{{ $t->tahun }}" {{ $t->tahun == $tahun ? 'selected' : '' }}>{{ $t->tahun }}</option>
                                                    @endforeach
                                                </select>
                                                <select style="width: 200px" class="form-select form-select-sm" name="semester" id="semester">
                                                    <option selected value="">Pilih Semester</option>
                                                    @foreach ($semester_list as $s)
                                                        <option value="{{ $s->semester }}" {{ $s->semester == $semester ? 'selected' : '' }}>{{ $s->semester }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button formaction="/sp" class="btn btn-sm btn-primary" type="submit">Filter</button>
                                        </div>
                                        <button formaction="/sp/print" type="submit" class="btn btn-primary btn-sm">
                                            Print
                                        </button>
                                    </div>
                                </form>

                                <table class="table table-borderless mt-3">
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
