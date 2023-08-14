@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')
@section('container')


        <div class="pagetitle">
            <h1>Detail User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ $authService->dashboardUrl() }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ $authService->dashboardUrl() . '/user' }}">User</a></li>
                    <li class="breadcrumb-item active">Detail User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
                    <!-- Card with an image on top -->
                    <div class="col-md-6 mt-4">
                    <div class="card">
                      <div style="background-color:rgba(33, 31, 31, 0.5)" class="position-absolute px-3 py-2 text-white">{{'By '.' : '. $user->nama_user }}</div>
                        <img style="max-width: 500px" src="{{ url('images').'/'.$user->foto_user }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{'Nama User '.' : '. $user->nama_user }}</h5>
                            <h6 class="card-text">{{'Email'.' : '. $user->email }}</h6>
                            <h6 class="card-text">{{'Level'.' : '. $user->level }}</h6>
                            {{-- <h6 class="card-text">{{'Stok : '.$user->stok_brg }}</h6> --}}
                        </div>
                      </div><!-- End Card with an image on top -->
                    </div>

@endsection
