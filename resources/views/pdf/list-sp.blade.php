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
                <th scope="col">No.</th>
                <th scope="col">Nama Mahasiswa</th>
                <th scope="col">NIM</th>
                <th scope="col">Prodi</th>
                <th scope="col">Kelas</th>
                <th scope="col">Semester</th>
                <th scope="col">Waktu Keterlambatan</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sp as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->mahasiswa->nama_mhs }}</td>
                <td>{{ $p->mahasiswa->nim }}</td>
                <td>{{ $p->mahasiswa->prodi->nama_prodi }}</td>
                <td>{{ $p->mahasiswa->kelas->nama_kelas }}</td>
                <td>{{ $p->semester->name }}</td>
                <td>{{ $p->waktu_keterlambatan }} Jam</td>
                <td>{{ $p->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
