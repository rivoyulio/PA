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
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
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

Route::get('/welcome', fn() => view('welcome'));

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
        Route::get('/', fn() => view('admins.dashboard'));

        Route::resource('/admin/data/user', UserController::class);
        Route::resource('/admin/data/mahasiswa', MahasiswaController::class)->except(['show']);
        Route::resource('/admin/data/dosen', DosenController::class);
        Route::resource('/admin/data/kelas', KelasController::class);
        Route::resource('/admin/data/prodi', ProdiController::class);
        Route::resource('/admin/data/agama', AgamaController::class);

        Route::get('/sp/print', [SpController::class, 'print'])->name('sp.print');
        Route::get('/pelanggaran/print', [PelanggaranController::class, 'print'])->name('pelanggaran.print');

        Route::get('kelas/detail/{id}','App\Http\Controllers\KelasController@kelasdetail');

        //route dosen
        Route::get('/dosen','App\Http\Controllers\DosenController@biodatadosen');
        Route::get('/dosen/mahasiswa','App\Http\Controllers\MahasiswaController@indexmahasiswa');
        Route::get('/dosen/mahasiswa/biodata','App\Http\Controllers\MahasiswaController@indexbiodata');
        Route::get('/dosen/bimbingan','App\Http\Controllers\BimbinganController@indexdosen');
        Route::get('/dosen/bimbingan/history','App\Http\Controllers\BimbinganController@indexhistory');
        Route::get('/dosen/bimbingan/detailbimbingan','App\Http\Controllers\BimbinganController@indexhistorydetail'); //baru bikin

        // route kaprodi
        Route::get('/kaprodi','App\Http\Controllers\KaprodiController@profile');

        Route::get('/laporan/kelas','App\Http\Controllers\LaporanController@kelas');
        Route::post('/laporan/kelas','App\Http\Controllers\LaporanController@print_kelas');
        Route::get('/laporan/mahasiswa-bimbingan', 'App\Http\Controllers\LaporanController@mahasiswa_bimbingan');
        Route::get('/laporan/mahasiswa-bimbingan/print', 'App\Http\Controllers\LaporanController@print_mahasiswa_bimbingan');
        Route::get('/laporan/mahasiswa-tidak-bimbingan', 'App\Http\Controllers\LaporanController@mahasiswa_tidak_bimbingan');
        Route::get('/laporan/mahasiswa-tidak-bimbingan/print', 'App\Http\Controllers\LaporanController@print_mahasiswa_tidak_bimbingan');

        // route mahasiswa
        Route::get('/mahasiswa','App\Http\Controllers\MahasiswaController@profile');
        Route::get('/mahasiswa/index','App\Http\Controllers\MahasiswaController@indexbiodata');
        Route::get('/mahasiswa/bimbingan','App\Http\Controllers\BimbinganController@indexdetail');
        // Route::get('/mahasiswa/bimbingan/detail','App\Http\Controllers\BimbinganController@indexdetail');
        Route::get('/mahasiswa/bimbingan/cetak','App\Http\Controllers\BimbinganController@cetak');

        // Shared
        Route::resource('/mahasiswa', MahasiswaController::class)->only(['show']);
        Route::resource('/bimbingan', BimbinganController::class)->except(['index']);
        Route::resource('/sp', SpController::class);
        Route::resource('/pelanggaran', PelanggaranController::class)->except(['show']);
    }
);

Route::get('/logout','App\Http\Controllers\AuthenticationController@logout');
