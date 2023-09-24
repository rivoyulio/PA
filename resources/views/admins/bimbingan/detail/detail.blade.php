@inject('authService', 'App\Http\Services\AuthService')

@extends('admins.layouts.main')

@section('container')

    <div class="pagetitle">
        <h1>Detail Bimbingan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Detail Mahasiswa</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg">
                <div class="row">

                    <!-- Recent Sales -->
                    <div class="col-6">

                        <div class="card recent-sales overflow-auto h-100">

                            <div class="card-body">
                                <h5 class="card-title">Detail Bimbingan Mahasiswa</h5>
                                @if($authService->currentUserIsMahasiswa())
                                <a target="_blank" href="/mahasiswa/bimbingan/cetak" class="btn btn-success">
                                    <i class="bi bi-file-earmark-break-fill"></i> Cetak Detail Bimbingan
                                </a>
                                @endif
                                <br>
                                <br>

                                <h6>Nama Dosen: {{ $bimbingan->mahasiswa->kelas->dosen->nama_dosen }}</h6><br>
                                <h6>Nama Mahasiswa : {{ $bimbingan->mahasiswa->nama_mhs }}</h6><br>
                                <h6>NIM : {{ $bimbingan->mahasiswa->nim }}</h6><br>
                                <h6>Kelas : {{ $bimbingan->mahasiswa->kelas->nama_kelas }}</h6><br>
                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <div class="col-6">
                        <div class="card recent-sales overflow-auto h-100">
                            <div class="card-body">
                                <div class="pt-4">Topik</div>
                                <h5 class="fw-bold">{{ $bimbingan->topic }}</h5>
                                <div>Tanggal</div>
                                <p class="fw-semibold">{{ $bimbingan->tanggal_bimbingan }}</p>
                                <div>Bimbingan</div>
                                <p>{{ $bimbingan->bimbingan }}</p>
                                <div>Permasalahan</div>
                                <p>{{ $bimbingan->pesan_mhs }}</p>
                                <div>Dokumen</div>
                                <a href="{{ Storage::url($bimbingan->file) }}" target="_blank">
                                    <div class="card rounded p-2">{{  \Illuminate\Support\Str::afterLast($bimbingan->file, '/')  }}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Left side columns -->


        </div>
        <!-- Conversation -->
        <div class="row mt-3">
            <div class="col-lg">
                <div class="card recent-sales overflow-hidden">
                    <div class="card-body row align-items-center">
                        <div class="col">
                            <h5 class="card-title">Diskusi</h5>
                        </div>
                        <div class="col card-title d-flex justify-content-end">
                            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalReply" id="createreply" style="border-radius: 50%;">+</button>
                        </div>
                        <div class="bg-light rounded w-100 overflow-auto">
                            <!-- conversation content -->
                            @forelse($bimbingan->reply as $data)
                                @if($data->mahasiswa)
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <div class="d-flex flex-row justify-content-between align-items-center mt-2">
                                                <h5 class="fw-bold">{{ $data->mahasiswa->nama_mhs }}</h5>
                                                <p>{{ $data->created_at->diffForHumans() }}</p>
                                            </div>
                                            <p>{{ $data->message }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="card mt-3">
                                        <div class="card-body p-2">
                                            <div class="d-flex flex-row justify-content-between align-items-center mt-2">
                                                <h5 class="fw-bold">{{ $data->dosen->nama_dosen }}</h5>
                                                <p>{{ $data->created_at->diffForHumans() }}</p>
                                            </div>
                                            <p>{{ $data->message }}</p>
                                        </div>
                                    </div>
                                @endif
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalReply" tabindex="-1" aria-labelledby="modalReply" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="p-2">
                        <h5 class="modal-title">Diskusi</h5>
                    </div>
                    <form action="{{ route('bimbingan.reply', $bimbingan->id_bimbingan) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mt-2">
                                <label for="message" class="form-label">Pesan</label>
                                <textarea name="message" id="message" cols="30" rows="10" class="form-control @error('message') is-invalid @enderror" placeholder="Masukkan Pesan"></textarea>
                            </div>
                            @error('message')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end conversation -->
    </section>
@endsection
