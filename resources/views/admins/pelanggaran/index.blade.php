@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')
@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert"">
            {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="pagetitle">
        <h1>Pelanggaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ $authService->dashboardUrl() }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Data Pelanggaran</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg">
                <div class="row">

                    <div class="col-12">
                        @if($authService->currentUserIsAdmin())
                            <a href="/pelanggaran/create" type="button" class="btn btn-primary btn-sm mb-4">+ Tambah Pelanggaran</a>
                        @endif
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Pelanggaran</h5>
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
                                            <button formaction="/pelanggaran" class="btn btn-sm btn-primary" type="submit">Filter</button>
                                        </div>
                                        <button formaction="/pelanggaran/print" type="submit" class="btn btn-primary btn-sm">
                                            Print
                                        </button>
                                    </div>
                                </form>

                                <div class="table-responsive mt-3">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                @if($authService->currentUserIsDosen() || $authService->currentUserIsAdmin())
                                                <th scope="col">Mahasiswa</th>
                                                <th scope="col">NIM</th>
                                                @endif
                                                <th scope="col">Pelanggaran</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Semester</th>
                                                <th scope="col">Prodi</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Komdis</th>
                                                @if($authService->currentUserIsAdmin())
                                                    <th scope="col">Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pelanggaran as $p)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    @if($authService->currentUserIsDosen() || $authService->currentUserIsAdmin ())
                                                    <td>{{ $p->mahasiswa->nama_mhs }}</td>
                                                    <td>{{ $p->mahasiswa->nim }}</td>
                                                    @endif
                                                    <td>{{ $p->kategori->name }}</td>
                                                    <td>{{ $p->tanggal }}</td>
                                                    <td>{{ $p->semester->name }}</td>
                                                    <td>{{ $p->mahasiswa->prodi->nama_prodi }}</td>
                                                    <td>{{ $p->mahasiswa->kelas->nama_kelas }}</td>
                                                    <td>{{ $p->komdis->dosen->nama_dosen }}</td>
                                                    

                                                    @if($authService->currentUserIsAdmin())
                                                        <td>
                                                            <a href="{{ url('/pelanggaran/' . $p->id_pelanggaran . '/edit/') }}" class="btn btn-link">
                                                                <span class="badge bg-warning text-dark">
                                                                    <i class="bi bi-info-circle"></i> Edit
                                                                </span>
                                                            </a>
                                                            <form action="{{ '/pelanggaran/' . $p->id_pelanggaran }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" id="#delete" class="btn btn-link">
                                                                    <span class="badge bg-danger text-dark">
                                                                        <i class="bi bi-trash"></i> Hapus
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    @endif
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


        </div>
    </section>
    @endsection
