@extends('pdf.layout')

@section('title', 'LAPORAN KELAS')
@section('subtitle', 'POLITEKNIK NEGERI PADANG')

@section('content')
<style>
    .kelas {
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
<div class="kelas">
    <div class="overview">
        <span>Nama Kelas: {{ $kelas->nama_kelas }}</span>
        <span>Tahun: {{ $tahun }}</span>
    </div>
    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Program Studi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $mhs)
                <tr>
                    <td style="width: 30px;">{{ $loop->iteration }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->nama_mhs }}</td>
                    <td>{{ $mhs->prodi->nama_prodi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
