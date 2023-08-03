@extends('admins.layouts.main')
@section('container')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto ">
                            <div class="card-body">
                                <h5 class="card-title">Biodata Mahasiswa</h5>
                                <div class="row">

                                    <div class="col-xl-4">
                                        <div class="card">
                                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                                <img
                                                    src="{{ url('images') .'/'. $mahasiswa->fotomhs }}"
                                                    height="50%"
                                                    width="50%"
                                                    alt="Profile"
                                                    class="rounded-circle"
                                                >

                                                <br>

                                                <h3>{{ $mahasiswa->nama_mhs }}</h3>
                                                <span>{{ $mahasiswa->nim }}</span>
                                                <span>{{ $mahasiswa->kelas->nama_kelas }}</span>
                                                <span>{{ $mahasiswa->prodi->nama_prodi }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-8">
                                        <div class="card">
                                            <div class="card-body pt-3">
                                                <div class="tab-content ">
                                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                                        <h5 class="card-title">
                                                            <i class="bi bi-file-earmark-person"></i> {{ $mahasiswa->nama_mhs }}
                                                        </h5>
                                                        @if(isset($mahasiswa))
                                                        <form class="row g-3">
                                                            <div class="col-md-6">
                                                                <label for="nim" class="form-label">
                                                                    NIM
                                                                </label>
                                                                <input type="text" class="form-control" id="nim" value="{{ $mahasiswa->nim }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="prodi" class="form-label">
                                                                    Prodi
                                                                </label>
                                                                <input type="text" class="form-control" id="prodi" value="{{ $mahasiswa->prodi->nama_prodi }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nama_mhs" class="form-label">
                                                                    Nama Lengkap
                                                                </label>
                                                                <input type="text" class="form-control" id="nama_mhs" value="{{ $mahasiswa->nama_mhs }}" >
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="kelas_id" class="form-label">Kelas</label>
                                                                <input type="text" class="form-control" id="kelas_id" value="{{ $mahasiswa->kelas->nama_kelas }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="tahun_angkatan" class="form-label">
                                                                    Tahun Angkatan
                                                                </label>
                                                                <input type="text" class="form-control" id="tahun_angkatan">
                                                            </div>
                                                            <!-- <div class="col-md-6">
                                                                <label for="password" class="form-label">
                                                                    Password
                                                                </label>
                                                                <input type="password" class="form-control" id="password" value="{{ $mahasiswa->password }}">
                                                            </div> -->
                                                            <div class="col-md-6">
                                                                <label for="nama_panggilan" class="form-label">
                                                                    Nama Panggilan
                                                                </label>
                                                                <input type="text" class="form-control" id="nama_panggilan" value="{{ $mahasiswa->nama_panggilan }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="agama" class="form-label">
                                                                    Agama
                                                                </label>
                                                                <input type="text" class="form-control" id="agama" value="{{ $mahasiswa->agama->agama }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="tempat_lahir" class="form-label">
                                                                    Tempat Lahir
                                                                </label>
                                                                <input type="text" class="form-control" id="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="tanggal_lahir" class="form-label">
                                                                    Tanggal Lahir
                                                                </label>
                                                                <input type="date" class="form-control" id="tanggal_lahir" value="{{ $mahasiswa->tanggal_lahir }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="jenis_kelamin" class="form-label">
                                                                    Jenis Kelamin
                                                                </label>
                                                                <input type="text" class="form-control" id="jenis_kelamin" value="{{ $mahasiswa->jenis_kelamin }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="no_hp" class="form-label">
                                                                    No Hp
                                                                </label>
                                                                <input type="text" class="form-control" id="no_hp" value="{{ $mahasiswa->no_hp }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="anak_ke" class="form-label">Anak Ke</label>
                                                                <input type="text" class="form-control" id="anak_ke" value="{{ $mahasiswa->anak_ke }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="jmlh_saudara" class="form-label">Jumlah Saudara</label>
                                                                <input type="text" class="form-control" id="jmlh_saudara" value="{{ $mahasiswa->jmlh_keluarga }}">
                                                            </div>
                                                        </form>
                                                        @endif

                                            </div>
                                        </div>
                                    </div>

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
