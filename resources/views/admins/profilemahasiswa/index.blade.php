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
