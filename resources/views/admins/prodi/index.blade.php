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
        <h1>Prodi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Prodi</li>
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

                        {{-- <button type="button" class="btn btn-primary btn-sm mb-4" data-bs-toggle="modal" data-bs-target="#basicModal">
                            +Tambah Barang
                          </button> --}}
                        <a href="/prodi/create" type="button" class="btn btn-primary btn-sm mb-4">+ Tambah Prodi</a>
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Prodi</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Prodi</th>
                                            <th scope="col">Nama Prodi</th>
                                            <th scope="col">Jenjang</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prodis as $prodi)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $prodi->kode_prodi }}</td>
                                                <td>{{ $prodi->nama_prodi }}</td>
                                                <td>{{ $prodi->jenjang }}</td>
                                                <td>
                                                    {{-- <a href="{{ url('/prodi/' . $prodi->id_prodi) }}" class="btn btn-link"><span
                                                        class="badge bg-info text-dark"><i
                                                        class="bi bi-info-circle"></i> Detail</span></a> --}}

                                                        <a href="{{ url('/prodi/' . $prodi->id_prodi . '/edit/') }}" class="btn btn-link"><span
                                                            class="badge bg-warning text-dark"><i
                                                            class="bi bi-info-circle"></i> Edit</span></a>

                                                        <a
                                                            action="{{ '/prodi/' . $prodi->id_prodi }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" id="#delete" class="btn btn-link"><span
                                                                    class="badge bg-danger text-dark"><i
                                                                        class="bi bi-trash"></i> Hapus</span></button>
                                                        </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    {{-- {{ $prodis->links() }} --}}
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
