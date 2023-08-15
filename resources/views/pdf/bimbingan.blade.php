@extends('pdf.layout')

@section('title', 'LAPORAN BIMBINGAN')
@section('subtitle', 'POLITEKNIK NEGERI PADANG')

@section('content')
<style>
    .bimbingan {
        padding: 24px 48px;
    }

    .overview > span {
        display: block;

        font-size: 0.8rem;
        font-weight: bold;

        margin: 4px 0;
    }

    .data {
        margin-top: 20px;
    }
</style>
<div class="bimbingan">
    <div class="overview">
        <span>Nama Dosen: {{ $mahasiswa->kelas->dosen->nama_dosen}}</span>
        <span>Nama Mahasiswa: {{ $mahasiswa->nama_mhs }}</span>
        <span>NIM: {{ $mahasiswa->nim }}</span>
        <span>Kelas: {{ $mahasiswa->kelas->nama_kelas }}</span>
    </div>
    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Bimbingang</th>
                <th>Bimbingan</th>
                <th>Permasalahan Mahasiswa</th>
                <th>Solusi Dosen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bimbingans as $bimbingan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bimbingan->tanggal_bimbingan  }}</td>
                <td>{{ $bimbingan->bimbingan }}</td>
                <td>{{ $bimbingan->pesan_mhs }}</td>
                <td>{{ $bimbingan->pesan_dosen }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
