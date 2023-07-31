<?php


use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfMahasiswaNotAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;

use Illuminate\Support\Facades\Route;

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

/**
 * Penjelasan Middleware
 * RedirectIfAuthenticated -> Jika user / mahasiswa sudah login
 * RedirectIfNotAuthenticated -> Jika user / mahasiswa belum login
 * RedirectIfUserNotAuthenticated -> Jika user belum login
 * RedirectIfMahasiswaNotAuthenticated -> Jika mahasiswa belum login
 */

Route::get('/', fn() => view('welcome'));

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('login','App\Http\Controllers\AuthenticationController@index');
    Route::post('login/proses','App\Http\Controllers\AuthenticationController@login');
    Route::get('register','App\Http\Controllers\AuthenticationController@pageRegister');
    Route::post('register/proses','App\Http\Controllers\AuthenticationController@register');
    Route::get('loginmahasiswa','App\Http\Controllers\LoginController@index');
    Route::post('loginmahasiswa/proses','App\Http\Controllers\LoginController@login');
});

Route::middleware([RedirectIfNotAuthenticated::class])->group(
    function() {
        //route admin
        Route::get('admin', fn() => view('admins.dashboard'));

        Route::resource('user', UserController::class);
        Route::resource('/admin/data/mahasiswa', MahasiswaController::class);
        Route::resource('/admin/data/dosen', DosenController::class);
        Route::resource('/admin/data/kelas', KelasController::class);
        Route::resource('/admin/data/prodi', ProdiController::class);
        Route::resource('/admin/data/agama', AgamaController::class);
        Route::resource('profile', ProfileController::class);
        Route::resource('bimbingan', BimbinganController::class);
        Route::resource('sp', SpController::class);
        Route::resource('pelanggaran', PelanggaranController::class);
        Route::get('kelas/detail/{id}','App\Http\Controllers\KelasController@kelasdetail');
        Route::get('kelas/create/{id}','App\Http\Controllers\KelasController@kelascreate');
        Route::delete('kelas/detail/delete/{id}','App\Http\Controllers\KelasController@delete');

        //route dosen
        Route::get('index','App\Http\Controllers\MahasiswaController@profile');
        Route::get('dosen','App\Http\Controllers\DosenController@biodatadosen');
        Route::get('dosenbimbingan','App\Http\Controllers\BimbinganController@indexdosen');
        Route::post('dosenbimbingan','App\Http\Controllers\BimbinganController@store');
        Route::put('dosenbimbingan/{id}','App\Http\Controllers\BimbinganController@update');
        Route::get('history','App\Http\Controllers\BimbinganController@indexhistory');
        Route::get('datamahasiswa','App\Http\Controllers\MahasiswaController@indexmahasiswa');

        // Route::get('detailbiodata','App\Http\Controllers\MahasiswaController@showbiodata');
        Route::delete('bimbingan/{id}','App\Http\Controllers\BimbinganController@destroy');

        // route mahasiswa
        Route::get('mahasiswa','App\Http\Controllers\MahasiswaController@indexbiodata');
        Route::get('detail','App\Http\Controllers\BimbinganController@indexdetail');
        Route::get('cetak','App\Http\Controllers\BimbinganController@cetak');
        Route::get('mahasiswabimbingan','App\Http\Controllers\BimbinganController@indexmahasiswa');

        Route::get('index','App\Http\Controllers\MahasiswaController@profile');
    }
);

// Route::middleware([RedirectIfMahasiswaNotAuthenticated::class])->group(
//     function() {
//         Route::get('index','App\Http\Controllers\MahasiswaController@profile');
//         Route::get('mahasiswabimbingan','App\Http\Controllers\BimbinganController@indexmahasiswa');
//     }
// );

Route::get('/logout','App\Http\Controllers\AuthenticationController@logout');
