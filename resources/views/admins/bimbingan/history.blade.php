@extends('admins.layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>History Bimbingan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">History Mahasiswa</li>
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

                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">History Bimbingan Mahasiswa</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Mahasiswa</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Program Studi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mahasiswas as $mahasiswa)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $mahasiswa->nama_mhs }}</td>
                                                <td>{{ $mahasiswa->nim }}</td>
                                                <td>{{ $mahasiswa->kelas->nama_kelas }}</td>
                                                <td>{{ $mahasiswa->prodi->nama_prodi }}</td>
                                                <td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    {{-- {{ $kelass->links() }} --}}
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
