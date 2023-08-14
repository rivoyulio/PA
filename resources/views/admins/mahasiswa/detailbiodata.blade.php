@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')
@section('container')
    <div class="pagetitle">
        <h1>Biodata Mahasiswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ $authService->dashboardUrl() }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Biodata Mahasiswa</li>
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
                                                />

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
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label for="nim" class="form-label">NIM</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="nim"
                                                                    name="nim"
                                                                    value="{{ $mahasiswa->nim }}"
                                                                    disabled
                                                                >
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="prodi" class="form-label">Prodi</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="prodi"
                                                                    name="prodi"
                                                                    value="{{ $mahasiswa->prodi->nama_prodi }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nama_mhs" class="form-label">Nama Lengkap</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="nama_mhs"
                                                                    name="nama_mhs"
                                                                    value="{{ $mahasiswa->nama_mhs }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="kelas" class="form-label">Kelas</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="kelas"
                                                                    name="kelas"
                                                                    value="{{ $mahasiswa->kelas->nama_kelas }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="tahun_angkatan" class="form-label">Tahun Angkatan</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="tahun_angkatan"
                                                                    name="tahun_angkatan"
                                                                    value="{{ $mahasiswa->tahun_angkatan }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nama_panggilan" class="form-label">Nama Panggilan</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="nama_panggilan"
                                                                    name="nama_panggilan"
                                                                    value="{{ $mahasiswa->nama_panggilan }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="agama" class="form-label">
                                                                    Agama
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="agama"
                                                                    name="agama"
                                                                    value="{{ $mahasiswa->agama->agama }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="tempat_lahir" class="form-label">
                                                                    Tempat Lahir
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="tempat_lahir"
                                                                    name="tempat_lahir"
                                                                    value="{{ $mahasiswa->tempat_lahir }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                                <input
                                                                    type="date"
                                                                    class="form-control"
                                                                    id="tgl_lahir"
                                                                    name="tgl_lahir"
                                                                    value="{{ old('tgl_lahir', $mahasiswa->tgl_lahir) }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="jekel" class="form-label">Jenis Kelamin</label>
                                                                <input
                                                                    type="date"
                                                                    class="form-control"
                                                                    id="jekel"
                                                                    name="jekel"
                                                                    value="{{ $mahasiswa->jekel }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="no_hp" class="form-label">No Hp</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="no_hp"
                                                                    name="no_hp"
                                                                    value="{{  $mahasiswa->no_hp }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="anak_ke" class="form-label">Anak Ke</label>
                                                                <input
                                                                    type="number"
                                                                    class="form-control"
                                                                    id="anak_ke"
                                                                    name="anak_ke"
                                                                    value="{{ $mahasiswa->anak_ke }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="jmlh_saudara" class="form-label">Jumlah Saudara</label>
                                                                <input
                                                                    type="number"
                                                                    class="form-control"
                                                                    id="jmlh_saudara"
                                                                    name="jmlh_saudara"
                                                                    value="{{ $mahasiswa->jmlh_saudara }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="provinsi" class="form-label">
                                                                    Provinsi
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="provinsi"
                                                                    name="provinsi"
                                                                    value="{{ $mahasiswa->provinsi }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="kabupaten" class="form-label">
                                                                    Kabupaten
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="kabupaten"
                                                                    name="kabupaten"
                                                                    value="{{ $mahasiswa->kabupaten }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="kecamatan" class="form-label">
                                                                    Kecamatan
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="kecamatan"
                                                                    name="kecamatan"
                                                                    value="{{ $mahasiswa->kecamatan }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="alamat_mhs" class="form-label">
                                                                    Alamat Mahasiswa
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="alamat_mhs"
                                                                    name="alamat_mhs"
                                                                    value="{{ $mahasiswa->alamat_mhs }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nama_sekolah" class="form-label">
                                                                    Nama Sekolah
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="nama_sekolah"
                                                                    name="nama_sekolah"
                                                                    value="{{ $mahasiswa->nama_sekolah }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="jurusan" class="form-label">
                                                                    Jurusan Sekolah
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="jurusan"
                                                                    name="jurusan"
                                                                    value="{{ $mahasiswa->jurusan }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="alamat_sekolah" class="form-label">
                                                                    Alamat Sekolah
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="alamat_sekolah"
                                                                    name="alamat_sekolah"
                                                                    value="{{ $mahasiswa->alamat_sekolah }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="prestasi" class="form-label">
                                                                    Prestasi
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="prestasi"
                                                                    name="prestasi"
                                                                    value="{{ $mahasiswa->prestasi }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nama_ortu" class="form-label">
                                                                    Nama Orangtua
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="nama_ortu"
                                                                    name="nama_ortu"
                                                                    value="{{ $mahasiswa->nama_ortu }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="alamat_ortu" class="form-label">
                                                                    Alamat Orangtua
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="alamat_ortu"
                                                                    name="alamat_ortu"
                                                                    value="{{ $mahasiswa->alamat_ortu }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="pekerjaan_ortu" class="form-label">
                                                                    Pekerjaan Orangtua
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="pekerjaan_ortu"
                                                                    name="pekerjaan_ortu"
                                                                    value="{{ $mahasiswa->pekerjaan_ortu }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nohp_ortu" class="form-label">
                                                                    No HP Orangtua
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="nohp_ortu"
                                                                    name="nohp_ortu"
                                                                    value="{{ $mahasiswa->nohp_ortu }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nama_wali" class="form-label">
                                                                    Nama Wali
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="nama_wali"
                                                                    name="nama_wali"
                                                                    value="{{ $mahasiswa->nama_wali }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="alamat_wali" class="form-label">
                                                                    Alamat Wali
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="alamat_wali"
                                                                    name="alamat_wali"
                                                                    value="{{ $mahasiswa->alamat_wali }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="pekerjaan_wali" class="form-label">
                                                                    Pekerjaan Wali
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="pekerjaan_wali"
                                                                    name="pekerjaan_wali"
                                                                    value="{{ $mahasiswa->pekerjaan_wali }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nohp_wali" class="form-label">
                                                                    No Hp Wali
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="nohp_wali"
                                                                    name="nohp_wali"
                                                                    value="{{ $mahasiswa->nohp_wali }}"
                                                                    disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="status_biodata" class="form-label">
                                                                    Status Biodata
                                                                </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="status_biodata"
                                                                    name="status_biodata"
                                                                    value="{{ $mahasiswa->status_biodata }}"
                                                                    disabled
                                                                />
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
                </div>
            </div>
        </div>
    </section>
@endsection
