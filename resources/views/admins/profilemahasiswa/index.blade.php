@inject('authService', 'App\Http\Services\AuthService')

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
                                                        <form method="POST" action="/admin/data/mahasiswa/{{ $mahasiswa->id_mhs }}" class="row g-3">
                                                            @csrf
                                                            @method('PUT')
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
                                                                <input type="hidden" name="id_prodi" value="{{ $mahasiswa->id_prodi }}">
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
                                                                    value="{{ old('nama_mhs', $mahasiswa->nama_mhs) }}"
                                                                />
                                                                @error('nama_mhs')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="kelas" class="form-label">Kelas</label>
                                                                <input type="hidden" name="id_kelas" value="{{ $mahasiswa->id_kelas }}">
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="kelas"
                                                                    name="kelas"
                                                                    value="{{ $mahasiswa->kelas->nama_kelas }}"
                                                                    disabled
                                                                />
                                                                @error('kelas_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="tahun_angkatan" class="form-label">Tahun Angkatan</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="tahun_angkatan"
                                                                    name="tahun_angkatan"
                                                                    value="{{ old('tahun_angkatan', $mahasiswa->tahun_angkatan) }}"
                                                                />
                                                                @error('tahun_angkatan')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="password" class="form-label">Password</label>
                                                                <input
                                                                    type="password"
                                                                    class="form-control"
                                                                    id="password"
                                                                    name="password"
                                                                    placeholder="Kosongkan, jika tidak mengubah"
                                                                />
                                                                @error('passsword')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nama_panggilan" class="form-label">Nama Panggilan</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="nama_panggilan"
                                                                    name="nama_panggilan"
                                                                    value="{{ old('nama_panggilan', $mahasiswa->nama_panggilan) }}"
                                                                />
                                                                @error('nama_panggilan')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="id_agama" class="form-label">
                                                                    Agama
                                                                </label>
                                                                <select class="form-select" id="id_agama" name="id_agama">
                                                                    <option selected>Pilih Agama</option>
                                                                    @foreach(\App\Models\Agama::all() as $agama)
                                                                        @if (old('id_agama', $mahasiswa->agama->id_agama) == $agama->id_agama)
                                                                            <option value="{{ $agama->id_agama }}" selected> {{ $agama->agama }}</option>
                                                                        @else
                                                                            <option value="{{ $agama->id_agama }}">{{ $agama->agama }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('id_agama')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir) }}"
                                                                />
                                                                @error('tempat_lahir')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                                <input
                                                                    type="date"
                                                                    class="form-control"
                                                                    id="tgl_lahir"
                                                                    name="tgl_lahir"
                                                                    value="{{ old('tgl_lahir', $mahasiswa->tgl_lahir) }}"
                                                                />
                                                                @error('tgl_lahir')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="jekel" class="form-label">Jenis Kelamin</label>
                                                                <select class="form-select" id="jekel" name="jekel">
                                                                    <option selected>Pilih Jenis Kelamin</option>
                                                                    @php($jekel = ['Pria', 'Wanita'])
                                                                    @foreach($jekel as $j)
                                                                        @if (old('jekel', $mahasiswa->jekel) == $j)
                                                                            <option value="{{ $j }}" selected> {{ $j }}</option>
                                                                        @else
                                                                            <option value="{{ $j }}">{{ $j }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('jekel')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="no_hp" class="form-label">No Hp</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="no_hp"
                                                                    name="no_hp"
                                                                    value="{{ old('no_hp', $mahasiswa->no_hp) }}"
                                                                />
                                                                @error('no_hp')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="anak_ke" class="form-label">Anak Ke</label>
                                                                <input
                                                                    type="number"
                                                                    class="form-control"
                                                                    id="anak_ke"
                                                                    name="anak_ke"
                                                                    value="{{ old('anak_ke', $mahasiswa->anak_ke) }}"
                                                                />
                                                                @error('anak_ke')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="jmlh_saudara" class="form-label">Jumlah Saudara</label>
                                                                <input
                                                                    type="number"
                                                                    class="form-control"
                                                                    id="jmlh_saudara"
                                                                    name="jmlh_saudara"
                                                                    value="{{ old('jmlh_saudara', $mahasiswa->jmlh_saudara) }}"
                                                                />
                                                                @error('jmlh_saudara')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('provinsi', $mahasiswa->provinsi) }}"
                                                                />
                                                                @error('provinsi')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('kabupaten', $mahasiswa->kabupaten) }}"
                                                                />
                                                                @error('kabupaten')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('kecamatan', $mahasiswa->kecamatan) }}"
                                                                />
                                                                @error('kecamatan')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('alamat_mhs', $mahasiswa->alamat_mhs) }}"
                                                                />
                                                                @error('alamat_mhs')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('nama_sekolah', $mahasiswa->nama_sekolah) }}"
                                                                />
                                                                @error('nama_sekolah')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('jurusan', $mahasiswa->jurusan) }}"
                                                                />
                                                                @error('jurusan')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('alamat_sekolah', $mahasiswa->alamat_sekolah) }}"
                                                                />
                                                                @error('alamat_sekolah')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('prestasi', $mahasiswa->prestasi) }}"
                                                                />
                                                                @error('prestasi')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('nama_ortu', $mahasiswa->nama_ortu) }}"
                                                                />
                                                                @error('nama_ortu')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('alamat_ortu', $mahasiswa->alamat_ortu) }}"
                                                                />
                                                                @error('alamat_ortu')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('pekerjaan_ortu', $mahasiswa->pekerjaan_ortu) }}"
                                                                />
                                                                @error('pekerjaan_ortu')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('nohp_ortu', $mahasiswa->nohp_ortu) }}"
                                                                />
                                                                @error('nohp_ortu')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('nama_wali', $mahasiswa->nama_wali) }}"
                                                                />
                                                                @error('nama_wali')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('alamat_wali', $mahasiswa->alamat_wali) }}"
                                                                />
                                                                @error('alamat_wali')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('pekerjaan_wali', $mahasiswa->pekerjaan_wali) }}"
                                                                />
                                                                @error('pekerjaan_wali')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('nohp_wali', $mahasiswa->nohp_wali) }}"
                                                                />
                                                                @error('nohp_wali')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                                    value="{{ old('status_biodata', $mahasiswa->status_biodata) }}"
                                                                />
                                                                @error('status_biodata')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
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
