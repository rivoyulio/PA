@extends('admins.layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
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
                        <div class="card recent-sales overflow-auto ">

                            <div class="card-body" style="background-color:">                

                                <h5 class="card-title">Biodata Mahasiswa</h5>
                                <div class="row">

                                <div class="col-xl-4">
                                    <div class="card" style="background-color: ">
                                      <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                        @if (Auth::guard('mahasiswa')->check())
                                            <img src=" {{ url('images').'/'. Auth::guard('mahasiswa')->user()->fotomhs }}" height="50%" width="50%" alt="Profile" class="rounded-circle"><br>
                                            <h3>{{ Auth::guard('mahasiswa')->user()->nama_mhs  }}</h3>
                                            <span>{{ Auth::guard('mahasiswa')->user()->nim }}</span>
                                            <span>{{ Auth::guard('mahasiswa')->user()->kelas->nama_kelas }}</span>
                                            <span>{{ Auth::guard('mahasiswa')->user()->prodi->nama_prodi }}</span>

                                        @endif
                                      </div>
                                    </div> 
                                </div> 
                                <div class="col-xl-8">

                                    <div class="card">
                                      <div class="card-body pt-3">
                                        <!-- Bordered Tabs -->
       
                
                                        <div class="tab-content ">
                            
                                          <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            
                                            <h5 class="card-title"><i class="bi bi-file-earmark-person"></i> {{ Auth::guard('mahasiswa')->user()->nama_mhs }}</h5>
                                            @if (isset($mahasiswa))
                                            <form class="row g-3">
                                              <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">NIM</label>
                                                <input type="text" class="form-control" id="inputPassword4" value="{{ $mahasiswa->nim }}">
                                              </div>
                                              <div class="col-md-6">
                                                <label for="inputPassword4" class="form-label">Prodi</label>
                                                <input type="text" class="form-control" id="inputPassword4" value="{{ $mahasiswa->prodi->nama_prodi }}">
                                              </div>
                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="inputEmail4" value="{{ $mahasiswa->nama_mhs }}" >
                                                  </div>
                                                  <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label">Kelas</label>
                                                    <input type="text" class="form-control" id="inputPassword4" value="{{ $mahasiswa->kelas->nama_kelas }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Tahun Angkatan</label>
                                                    <input type="text" class="form-control" id="inputEmail4">
                                                </div>
                                                  <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="inputPassword4" value="{{ $mahasiswa->password }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Nama Panggilan</label>
                                                    <input type="text" class="form-control" id="inputEmail4">
                                                </div>
                                                  <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label">Agama</label>
                                                    <input type="text" class="form-control" id="inputPassword4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="inputEmail4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="inputPassword4">
                                                </div>
                                                <div class="col-md-6">
                                                  <label for="inputEmail4" class="form-label">Jenis Kelamin</label>
                                                  <input type="text" class="form-control" id="inputEmail4">
                                                </div>
                                                <div class="col-md-6">
                                                  <label for="inputPassword4" class="form-label">No Hp</label>
                                                  <input type="text" class="form-control" id="inputPassword4">
                                                </div>
                                                <div class="col-md-6">
                                                  <label for="inputEmail4" class="form-label">Anak Ke</label>
                                                  <input type="text" class="form-control" id="inputEmail4">
                                                </div>
                                                <div class="col-md-6">
                                                  <label for="inputPassword4" class="form-label">Jumlah Saudara</label>
                                                  <input type="text" class="form-control" id="inputPassword4">
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

                </div>
            </div><!-- End Left side columns -->


        </div>
    </section>

    <!-- The Modal -->
    <div id="modal_img" class="modal-image">
        <span class="close">&times;</span>
        <img class="modal-content-image" id="img01">
        <div id="caption"></div>
    </div>

@endsection
