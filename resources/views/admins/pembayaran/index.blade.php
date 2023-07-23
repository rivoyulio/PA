@extends('admins.layouts.main')

@section('container')
    
    <h1>pembayaran</h1>
    <form id="input">
        <div class="mb-3" >
            <label for="uang-masuk" class="form-label">Uang Masuk</label>
            <input type="text" class="form-control" id="uang-masuk" aria-describedby="emailHelp">
            <div  class="form-text">Uang masuk setiap pertandingan</div>
        </div>
    </form>
    <button id="convert" class="btn btn-primary">Convert</button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>

        $(document).ready(function(){
            var uangMasuk = document.getElementById('uang-masuk');
            $('#convert').click(function(){
                var wasit = uangMasuk.value - 100000;
                $('#input').append('<div class="mb-3"><label for="Gaji Wasit" class="form-label">Gaji wasit</label><input type="text" name="wasit" class="form-control" id="gaji-wasit" value="'+100000+'"></div>');
                
                var laundry = wasit - 50000;
                $('#input').append('<div class="mb-3"><label for="Laundry" class="form-label">Laundry</label><input type="text" name="laundry" class="form-control" id="laundry" value="'+50000+'"></div>');

                var fotographer = laundry - 100000;
                $('#input').append('<div class="mb-3"><label for="Fotographer" class="form-label">Fotographer</label><input type="text" name="fotographer" class="form-control" id="fotographer" value="'+100000+'"></div>');

                var korlap = fotographer - 50000;
                $('#input').append('<div class="mb-3"><label for="Korlap" class="form-label">Korlap</label><input type="text" name="korlap" class="form-control" id="korlap" value="'+50000+'"></div>');

                var admin = korlap - 50000;
                $('#input').append('<div class="mb-3"><label for="Admin" class="form-label">Admin</label><input type="text" name="admin" class="form-control" id="admin" value="'+50000+'"></div>');

                var sewa_lapangan = admin - 100000;
                $('#input').append('<div class="mb-3"><label for="Sewa Lapangan" class="form-label">Sewa Lapangan</label><input type="text" name="sewa_lapangan" class="form-control" id="sewa-lapangan" value="'+100000+'"></div>');

                var air_mineral = sewa_lapangan - 15000;
                $('#input').append('<div class="mb-3"><label for="Air Mineral" class="form-label">Air Mineral</label><input type="text" name="air_mineral" class="form-control" id="air-mineral" value="'+15000+'"></div>');

                var konten_kreator = air_mineral - 50000;
                $('#input').append('<div class="mb-3"><label for="Konten Kreator" class="form-label">Konten Kreator</label><input type="text" name="konten_kreator" class="form-control" id="konten-kreator" value="'+50000+'"></div>');

                var kid_man = konten_kreator - 20000;
                $('#input').append('<div class="mb-3"><label for="Kid Man" class="form-label">Kid Man</label><input type="text" name="kid_man" class="form-control" id="kid_man" value="'+20000+'"></div>');


                $('#input').append('<h5>Laba : '+kid_man+'</h5>')
                console.log(kid_man);
            });
        });
    </script>

@endsection