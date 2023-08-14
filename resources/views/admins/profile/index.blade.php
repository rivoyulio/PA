@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')
@section('container')
<div class="pagetitle">
  <h1>Profile</h1>
  <nav>
      <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ $authService->dashboardUrl() }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Profile</li>
      </ol>
  </nav>
</div>
    <section class="section profile">
    <div class="row">
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src=" {{ url('images').'/'. Auth::user()->foto_user }}" style="border-radius: 50%;" alt="Profile" class="rounded-circle">
            <h2></h2><br>
            <h3>{{ Auth::user()->nama_user }}</h3>
            <h3>{{ Auth::user()->level }}</h3>
          </div>
        </div>
      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>


            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <h5 class="card-title">Profile</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nama User</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->nama_user }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Level</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->level }}</div>
                  </div>
                  @foreach ($users as $user)
                  @endforeach

                <div class="text-center">
                  <a href="{{ url('/profile/' . $user->id_user . '/edit/') }}" class="btn btn-dark">Edit Profile</a>
                </div>


              </div>

            </div>

          </div>
        </div>

      </div>
    </div>
  </section>
  @endsection
