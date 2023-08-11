@extends('pdf.layout')

@section('title', 'LAPORAN SP')
@section('subtitle', 'POLITEKNIK NEGERI PADANG')

@section('content')
<style>
    .sp {
        padding: 24px 48px;
    }

    .data {
        margin-top: 20px;
    }
</style>
<div class="sp">
    <table class="data">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">NIM</th>
                <th scope="col">Kelas</th>
                <th scope="col">SP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggaran as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->mahasiswa->nama_mhs }}</td>
                    <td>{{ $p->mahasiswa->nim }}</td>
                    <td>{{ $p->mahasiswa->kelas->nama_kelas }}</td>
                    <td>{{ $p->sp->nama_sp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
