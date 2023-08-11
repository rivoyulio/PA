@extends('admins.layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Cetak Laporan Perkelas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/kaprodi') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Cetak Laporan Perkelas</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <form method="post" action="{{ url('/laporan/kelas') }}">
            @csrf
            <div class="card">
                <div class="card-body pt-3">
                    <div class="d-flex flex-row align-items-end">
                        <div class="flex-grow-1 row gx-2">
                            <div class="col">
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select class="form-select @error('id_kelas') is-invalid @enderror" name="id_kelas">
                                    <option selected value="">Pilih Kelas</option>
                                    @foreach($kelas as $k)
                                        @if (old('id_kelas') == $k->nama_kelas)
                                            <option value="{{ $k->id_kelas }}" selected>{{ $k->nama_kelas }}</option>
                                        @else
                                            <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select class="form-select @error('tahun') is-invalid @enderror" name="tahun">
                                    <option selected value="">Pilih Tahun</option>
                                    @foreach($tahun as $t)
                                        @if (old('tahun') == $t)
                                            <option value="{{ $t }}" selected>{{ $t }}</option>
                                        @else
                                            <option value="{{ $t }}">{{ $t }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="ps-3">
                            <input type="submit" class="btn btn-primary btn-md" value="Cetak" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
