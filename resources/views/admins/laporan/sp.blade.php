@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')
@section('container')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ $authService->dashboardUrl() }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <form method="post" action="{{ url('/laporan/sp') }}">
            @csrf
            <div class="card">
                <div class="card-body pt-3">
                    <div class="d-flex flex-row align-items-end">
                        <div class="flex-grow-1 row gx-2">
                            <div class="col">
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select class="form-select @error('id_kelas') is-invalid @enderror" name="id_kelas">
                                    <option selected value="">Pilih Kelas</option>
                                    @foreach($kelas as $k)
                                        @if (old('id_kelas') == $k->nama_kelas)
                                            <option value="{{ $k->id_kelas }}" selected>{{ $k->nama_kelas }}</option>
                                        @else
                                            <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select class="form-select @error('tahun') is-invalid @enderror" name="tahun">
                                    <option selected value="">Pilih Tahun</option>
                                    @foreach($tahun as $t)
                                        @if (old('tahun') == $t)
                                            <option value="{{ $t }}" selected>{{ $t->tahun_angkatan }}</option>
                                        @else
                                            <option value="{{ $t }}">{{ $t->tahun_angkatan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="ps-3">
                            <input type="submit" class="btn btn-primary btn-md" value="Cetak" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">{{ $title }}</h5>
                                {{-- <a href="{{ url()->current() }}/print" target="_blank" type="button" class="btn btn-primary btn-sm mb-4">
                                    Print
                                </a> --}}

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Semester</th>
                                            <th scope="col">Jenjang</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Waktu Alfa</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sp as $sp)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $sp->mahasiswa->nama_mhs }}</td>
                                                <td>{{ $sp->mahasiswa->nim }}</td>
                                                <td>{{ $sp->mahasiswa->kelas->nama_kelas }}</td>
                                                <td>{{ $sp->semester->name }}</td>
                                                <td>{{ $sp->mahasiswa->kelas->prodi->jenjang }}</td>
                                                <td>{{ $sp->mahasiswa->kelas->prodi->nama_prodi }}</td>
                                                <td>{{ $sp->alfa }} jam</td>
                                                <td>{{ $sp->status }}</td>
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
