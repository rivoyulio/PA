<!DOCTYPE html>
<html>
<head>
	<title>Laporan Bimbingan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h2>Laporan Bimbingan</h2>
		<h3>Jurusan Teknologi Informasi</h3>    
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal Bimbingan</th>
				<th>Bimbingan</th>
				<th>Permasalahan Mahasiswa</th>
				<th>Solusi Dosen</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($bimbingans as $bimbingan)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$bimbingan->tanggal_bimbingan}}</td>
				<td>{{$bimbingan->bimbingan}}</td>
				<td>{{$bimbingan->pesan_mhs}}</td>
				<td>{{$bimbingan->pesan_dosen}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>