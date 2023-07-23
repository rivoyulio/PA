<?php


use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/','App\Http\Controllers\Controller@index');

Route::middleware([''])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('prodi', ProdiController::class);
    Route::resource('agama', AgamaController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('bimbingan', BimbinganController::class);

    Route::get('/kelas/detail/{id}','App\Http\Controllers\KelasController@kelasdetail');
    Route::get('/kelas/create/{id}','App\Http\Controllers\KelasController@kelascreate');
    Route::delete('/kelas/detail/delete/{id}','App\Http\Controllers\KelasController@delete');

    Route::get('datamahasiswa','App\Http\Controllers\MahasiswaController@indexmahasiswa');

    Route::get('index','App\Http\Controllers\MahasiswaController@profile');
    Route::get('biodata','App\Http\Controllers\MahasiswaController@indexbiodata');
    Route::get('/biodatadosen','App\Http\Controllers\DosenController@biodatadosen');
    // Route::get('detailbiodata','App\Http\Controllers\MahasiswaController@showbiodata');

    Route::post('/dosenbimbingan','App\Http\Controllers\BimbinganController@store');
    Route::get('/dosenbimbingan','App\Http\Controllers\BimbinganController@indexdosen');
    Route::get('/mahasiswabimbingan','App\Http\Controllers\BimbinganController@indexmahasiswa');
    Route::get('/history','App\Http\Controllers\BimbinganController@indexhistory');
    Route::get('/detail','App\Http\Controllers\BimbinganController@indexdetail');
    Route::delete('/bimbingan/{id}','App\Http\Controllers\BimbinganController@destroy');
    Route::put('/dosenbimbingan/{id}','App\Http\Controllers\BimbinganController@update');
    Route::get('/cetak','App\Http\Controllers\BimbinganController@cetak');


    Route::get('/dashboard', function () {
        return view('admins.dashboard');
    });
    
});

Route::middleware(['MahasiswaLogin'])->group(function () {

    Route::resource('profile', ProfileController::class);
    Route::resource('bimbingan', BimbinganController::class);

    Route::get('index','App\Http\Controllers\MahasiswaController@profile');
    Route::get('/mahasiswabimbingan','App\Http\Controllers\BimbinganController@indexmahasiswa');
    Route::get('/detail','App\Http\Controllers\BimbinganController@indexdetail');

    Route::get('/dashboard', function () {
        return view('admins.dashboard');
    });
    
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', 'ProfileController@index')->name('profile.index');
//     Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
//     Route::put('/profile', 'ProfileController@update')->name('profile.update');
// });


Route::middleware(['AfterLogin'])->group(function () {
    Route::get('/login','App\Http\Controllers\AuthenticationController@index');
    Route::post('/login/proses','App\Http\Controllers\AuthenticationController@login');
    Route::get('/register','App\Http\Controllers\AuthenticationController@pageRegister');
    Route::post('/register/proses','App\Http\Controllers\AuthenticationController@register');
    Route::get('/loginmahasiswa','App\Http\Controllers\LoginController@index');
    Route::post('/loginmahasiswa/proses','App\Http\Controllers\LoginController@login');
});


Route::get('/logout','App\Http\Controllers\AuthenticationController@logout');