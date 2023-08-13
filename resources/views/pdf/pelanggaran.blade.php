@extends('pdf.layout')

@section('title', 'LAPORAN PELANGGARAN')
@section('subtitle', 'POLITEKNIK NEGERI PADANG')

@section('content')
<style>
    .pelanggaran {
        padding: 24px 48px;
    }

    .data {
        margin-top: 20px;
    }
</style>
<div class="pelanggaran">
    <table class="data">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">SP</th>
                <th scope="col">Pelanggaran</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Semester</th>
                <th scope="col">Nama Mahasiswa</th>
                <th scope="col">Prodi</th>
                <th scope="col">Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggaran as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->sp->nama_sp }}</td>
                    <td>{{ $p->pelanggaran }}</td>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->semester }}</td>
                    <td>{{ $p->mahasiswa->nama_mhs }}</td>
                    <td>{{ $p->mahasiswa->prodi->nama_prodi }}</td>
                    <td>{{ $p->mahasiswa->kelas->nama_kelas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
