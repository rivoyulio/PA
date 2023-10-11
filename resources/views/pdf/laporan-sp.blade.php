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

    .child-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .child-table th {
        border-top: 1px solid rgba(0, 0, 0, .5);
        border-bottom: none;
    }
    .child-table tr, .child-table td {
        width: 33%;
        border-top: 1px solid rgba(0, 0, 0, .5);
        border-bottom: none;
        text-align: start;

    }
</style>
<div class="pelanggaran">
    <table class="data">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Mahasiswa</th>
                <th scope="col">Tahun</th>
                <th scope="col">Prodi</th>
                <th scope="col">Kelas</th>
                <th scope="col">Daftar SP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama_mhs }}</td>
                    <td>{{ $p->tahun_angkatan }}</td>
                    <td>{{ $p->prodi->nama_prodi }}</td>
                    <td>{{ $p->kelas->nama_kelas }}</td>
                    <table class="child-table">
                        <thead>
                            <th>Semester</th>
                            <th>Jumlah Alfa</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @foreach($p->sp as $data)
                            <tr>
                                <td>{{ $data->semester->name }}</td>
                                <td>{{ $data->alfa }}</td>
                                <td>{{ $data->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
