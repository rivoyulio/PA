@extends('admins.layouts.main')

@section('container')
  @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert"">
            Data Berhasil di Tambah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('pesan_edit'))
        <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert"">
            Data Berhasil di Edit
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('pesan_hapus'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert"">
            Data Berhasil di Hapus
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="pagetitle">
        <h1>Dashboard</h1>
        {{-- <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="profile">Dashboard</a></li>
                <li class="breadcrumb-item active">Kelas</li>
            </ol>
        </nav> --}}
    </div>
    <section class="section profile">

      <div class="col-xl-9">

        <div class="card">
          <div class="card-body pt-2">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Biodata</button>
              </li>


            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <h5 class="card-title">Bioadata Lengkap</h5>
                @if ($dosen)
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nama Dosen</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen->nama_dosen }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">NIP</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen->nip }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tempat Lahir</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen->tempat_lahir }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen->tgl_lahir }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen->alamat }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">No Hp</div>
                    <div class="col-lg-9 col-md-8">{{ $dosen->notelp }}</div>
                </div>

                <div class="text-center">
                    {{-- <a href="/profile/{{ $profiles->user_id }}" class="btn btn-dark">Edit Profile</a> --}}
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    Tidak ada data dosen yang tersedia.
                </div>
            @endif
              </div>
         
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>
  @endsection  