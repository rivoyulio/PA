@extends('pdf.layout_sp')

@section('title', 'LAPORAN SP')
@section('subtitle', 'POLITEKNIK NEGERI PADANG')
@section('subtitle', 'JURUSAN'.$pelanggaran->mahasiswa->prodi->jenjang)
@section('content')
<style>
    

.data {
    width: auto;
    margin-top: 20px;
    padding-top: 30px;
    padding-left: 48px;
    padding-right: 48px;
    padding-bottom: 80px;

}

.data .p {
    line-height: 1.8;
}

table, tr, td, th {
    border: none !important;
    text-align: left;
    margin-top: 30px;
}
  
</style>
<div class="data">
    <p>Teriring salam dan doa semoga Allah S.W.T senantiasa melimpahkan Rahmat dan Karunia-Nya kepada kita semua dalam menjalankan aktifitas sehari-hari. Amin</p>
    <br>
    <p>Berdasarkan Peraturan Akademik Politeknik Negeri Padang Nomor : 4597/PL/DL/2018 Pasal 26 tentang “Sanksi Ketidakhadiran Mahasiswa” Menurut data absensi yang ada pada jurusan {{ $pelanggaran->mahasiswa->prodi->jenjang }} {{ $pelanggaran->mahasiswa->prodi->nama_prodi }} ketidakhadiran perkuliahan anda telah mencapai {{ $pelanggaran->waktu_keterlambatan }} jam</p>
    <p>Dengan ini memberikan surat peringatan 1 kepada saudara :</p>

    <table>
        <tr>
            <th>Nama : </th>
            <td>{{ $pelanggaran->mahasiswa->nama_mhs }}</td>
        </tr>
        <tr>
            <th>NIM : </th>
            <td>{{ $pelanggaran->mahasiswa->nim }}</td>
        </tr>
        <tr>
            <th>Kelas : </th>
            <td>{{ $pelanggaran->mahasiswa->kelas->nama_kelas }}</td>
        </tr>
        <tr>
            <th>Waktu Keterlambatan : </th>
            <td>{{ $pelanggaran->waktu_keterlambatan }}</td>
        </tr>
        <tr>
            <th>Status : </th>
            <td>{{ $pelanggaran->status }}</td>
        </tr>
    </table>
</div>
<div>
</div>
@endsection
