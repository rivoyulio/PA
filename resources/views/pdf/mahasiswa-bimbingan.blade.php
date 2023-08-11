@extends('pdf.layout')

@section('title', 'LAPORAN '.$title)
@section('subtitle', 'POLITEKNIK NEGERI PADANG')

@section('content')
<style>
    .mahasiswa-bimbingan {
        padding: 24px 48px;
    }

    .data {
        margin-top: 20px;
    }
</style>
<div class="mahasiswa-bimbingan">
    <table class="data">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIP</th>
                <th scope="col">Nama Dosen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $mhs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mhs->nama_mhs }}</td>
                    <td>{{ $mhs->kelas->dosen->nama_dosen }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
