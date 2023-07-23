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
        <h1>Bimbingan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Bimbingan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg">
                <div class="row">
                    <div class="col-12">
                        <form action="/dosenbimbingan" method="post" enctype="multipart/form-data">
                            @csrf
                             <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Bimbingan Mahasiswa</h5>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Mahasiswa</label>
                                    <input type="text" name="id_mhs" class="form-control @error('id_mhs') is-invalid @enderror"  id="id_mhs" value="{{ old('id_mhs') }}">
                                    @error('id_mhs')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Dosen</label>
                                    <input type="text" name="id_dosen" class="form-control @error('id_dosen') is-invalid @enderror" id="id_dosen" value="{{ old('id_dosen') }}" autofocus placeholder="">
                                    @error('id_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div> --}}
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Tanggal Bimbingan</label>
                                    <input type="date" name="tanggal_bimbingan" class="form-control @error('tanggal_bimbingan') is-invalid @enderror" id="tanggal_bimbingan" value="{{ old('tanggal_bimbingan') }}" autofocus placeholder="">
                                    @error('tanggal_bimbingan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Bimbingan</label>
                                    <textarea class="form-control" name="bimbingan" @error('bimbingan') is-invalid @enderror" id="bimbingan" value="{{ old('bimbingan') }}" rows="4">@error('bimbingan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Permasalahan Mahasiswa</label>
                                    <textarea class="form-control" name="pesan_mhs"  @error('pesan_mhs') is-invalid @enderror" id="pesan_mhs" value="{{ old('pesan_mhs') }}" rows="4">@error('pesan_mhs')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </textarea>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>

                            </div>
                        </form> 
                    </div><!-- End Recent Sales -->

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
