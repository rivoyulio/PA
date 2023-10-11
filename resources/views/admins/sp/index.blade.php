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
                        <a href="/sp/create" type="button" class="btn btn-primary btn-sm mb-4">+ Tambah SP</a>
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
                                                        <option value="{{ $s->id_semester }}">{{ $s->semester->name }}</option>
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
                                            <th scope="col">Nama Mahasiswa</th>
                                            <th>Prodi</th>
                                            <th>Kelas</th>
                                            <th>Dosen PA</th>
                                            <th>Jam Alfa</th>
                                            <th>SMT</th>
                                            <th scope="col">Status</th>
                                            <th>Tanggal</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sp as $sp)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $sp->mahasiswa->nama_mhs }}</td>
                                                <td>{{ $sp->mahasiswa->prodi->nama_prodi }}</td>
                                                <td>{{ $sp->mahasiswa->kelas->nama_kelas }}</td>
                                                <td>{{ $sp->mahasiswa->kelas->dosen->nama_dosen }}</td>
                                                <td>{{ $sp->alfa }} jam</td>
                                                <td>{{ $sp->id_semester }}</td>
                                                <td>{{ $sp->status }}</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $sp->tanggal)->format('d/m/Y') }}</td>
                                                <td>
                                                    <a href="{{ url('/sp/' . $sp->id_sp . '/edit/') }}" class="btn btn-link">
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="bi bi-info-circle"></i> Edit
                                                        </span>
                                                    </a>
                                                    <form action="{{ '/sp/' . $sp->id_sp }}" method="POST" style="display: inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" id="#delete" class="btn btn-link">
                                                            <span class="badge bg-danger text-dark">
                                                                <i class="bi bi-trash"></i> Hapus
                                                            </span>
                                                        </button>
                                                    </form>
                                                    @if($sp->surat)
                                                        <a href="{{ Storage::url($sp->surat) }}" target="_blank">
                                                            Buka Surat
                                                        </a>
                                                    @else -
                                                    @endif
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
