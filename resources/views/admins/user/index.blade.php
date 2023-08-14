@inject('authService', 'App\Http\Services\AuthService')

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
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ $authService->dashboardUrl() }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">User</li>
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

                        <a href="/user/create" type="button" class="btn btn-primary btn-sm mb-4">+ Tambah User</a>
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">User</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama User</th>
                                            <th scope="col">Email</th>
                                            {{-- <th scope="col">Password</th> --}}
                                            <th scope="col">Level</th>
                                            <th scope="col">Foto</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->nama_user }}</td>
                                                <td>{{ $user->email }}</td>
                                                {{-- <td>{{ $user->password }}</td> --}}
                                                <td>{{ $user->level }}</td>
                                                <td>
                                                    @if ($user->foto_user)
                                                        <img id="myImg"
                                                            src="{{ url('images') . '/' . $user->foto_user }}"
                                                            alt="{{ $user->nama_foto }}" style="max-width:80px">
                                                    @endif
                                                </td>
                                                <td>

                                                    <a href="{{ url('/user/' . $user->id_user) }}" class="btn btn-link"><span
                                                        class="badge bg-info text-dark"><i
                                                        class="bi bi-info-circle"></i> Detail</span></a>

                                                        <a href="{{ url('/user/' . $user->id_user . '/edit/') }}" class="btn btn-link"><span
                                                            class="badge bg-warning text-dark"><i
                                                            class="bi bi-info-circle"></i> Edit</span></a>

                                                    <form
                                                        action="{{ '/user/' . $user->id_user }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" id="#delete" class="btn btn-link"><span
                                                                class="badge bg-danger text-dark"><i
                                                                    class="bi bi-trash"></i> Hapus</span></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $users->links() }}
                            </div>

                        </div>
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
