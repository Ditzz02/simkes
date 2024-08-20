<?php

use App\Http\Middleware\DebugRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhsController;
use App\Http\Controllers\KrsController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\BerandaController;
use App\Http\Middleware\AddNotificationData;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProdiController;

Route::get('/', function () {
    return view('Template.welcome');
});

Route::get('/login', function () {
    return view('pengguna.login');
})->name('login');

Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

route::group(['middleware' => ['auth:kaprodi']], function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    Route::get('/kaprodi/konsultasi', [KaprodiController::class, 'index'])->name('kaprodi-index');
    Route::get('/kaprodi/konsultasi/{id}', [KaprodiController::class, 'show'])->name('kaprodi-show');
    Route::get('/kaprodi/{id}/approve', [KaprodiController::class, 'approve'])->name('kaprodi-approve');
});

route::group(['middleware' => ['auth:mahasiswa']], function () {
    Route::get('/konsultasi/print', [PrintController::class, 'printDaftarKonsultasi'])->name('konsul-print');
    Route::get('/kemajuan/print', [PrintController::class, 'printKemajuanStudi'])->name('studi-print');
    Route::delete('/konsultasi/{id}', [KonsultasiController::class, 'destroy'])->name('konsul-delete');

});

route::group(['middleware' => ['auth:mahasiswa,dosen,user,kaprodi']], function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profil');
    Route::put('/profil/update', [UserController::class, 'editProfil'])->name('update_profile');
    Route::get('/mahasiswa/daftar', [MahasiswaController::class, 'index'])->name('daftar_mahasiswa');
    Route::get('/mahasiswa/tambah', [MahasiswaController::class, 'create'])->name('tambah_mahasiswa');
});

route::group(['middleware' => ['auth:dosen,mahasiswa']], function () {
    Route::get('/konsultasi/{id}', [KonsultasiController::class, 'show'])->name('konsul-show');
    Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsul-index');
    Route::get('/konsultasi/create/konsul', [KonsultasiController::class, 'create'])->name('konsul-create');
    Route::post('/konsultasi/tambah', [KonsultasiController::class, 'store'])->name('konsul-store');
    Route::post('/konsultasi/{id}/respond', [KonsultasiController::class, 'respond'])->name('konsul-respond');
    Route::get('mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('tampil-mahasiswa');

});


route::group(['middleware' => ['auth:user']], function () {

    Route::get('/nilai', [NilaiController::class, 'index'])->name('show-nilai');
    Route::get('/get-krs', [NilaiController::class, 'getKrs'])->name('get-krs');
    Route::post('/simpan-nilai', [NilaiController::class, 'simpanNilai'])->name('nilai-simpan');

    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi');
    Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi-tambah');
    Route::post('/prodi/simpan', [ProdiController::class, 'store'])->name('prodi-simpan');
    Route::get('/prodi/edit/{id}', [ProdiController::class, 'edit'])->name('prodi-edit');
    Route::put('/prodi/update/{id}', [ProdiController::class, 'update'])->name('prodi-update');
    Route::get('/prodi/show/{id}', [ProdiController::class, 'show'])->name('prodi-show');
    Route::delete('/prodi/delete/{id}', [ProdiController::class, 'destroy'])->name('prodi-hapus');

    Route::get('krs/create', [KrsController::class, 'create'])->name('tambah-krs');
    Route::post('krs/store', [KrsController::class, 'store'])->name('simpan-krs');
    Route::get('/krs/daftar-mahasiswa', [KrsController::class, 'index'])->name('daftar-krs');
    Route::post('/krs/add-grade', [KrsController::class, 'addGrade'])->name('nilai-krs');

    Route::get('/mahasiswa/{id}/khs', [KHSController::class, 'show'])->name('tampil-khs');
    Route::get('/khs', [KhsController::class, 'tampil'])->name('show-khs');

    Route::post('/simpan-mahasiswa', [MahasiswaController::class, 'store'])->name('simpan_mahasiswa');
    Route::get('/mahasiswa/edit/{id?}', [MahasiswaController::class, 'edit'])->name('edit_mahasiswa');
    Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('update_mahasiswa');
    Route::delete('/mahasiswa/hapus/{id?}', [MahasiswaController::class, 'destroy'])->name('hapus_mahasiswa');
    Route::put('/mahasiswa/{id}/update-ipk', [MahasiswaController::class, 'updateNilai'])->name('update_ipk');

    Route::get('/dosen/daftar', [DosenController::class, 'index'])->name('daftar_dosen');
    Route::get('/dosen/tambah', [DosenController::class, 'create'])->name('tambah_dosen');
    Route::post('/simpan-dosen', [DosenController::class, 'store'])->name('simpan_dosen');
    Route::get('/dosen/edit/{id?}', [DosenController::class, 'edit'])->name('edit_dosen');
    Route::put('/dosen/update/{id}', [DosenController::class, 'update'])->name('update_dosen');
    Route::delete('/dosen/hapus/{id?}', [DosenController::class, 'destroy'])->name('hapus_dosen');

    Route::get('/mk/daftar', [MatakuliahController::class, 'index'])->name('daftar_mk');
    Route::get('/mk/tambah', [MatakuliahController::class, 'create'])->name('tambah_mk');
    Route::post('/simpan-mk', [MatakuliahController::class, 'store'])->name('simpan_mk');
    Route::get('/mk/edit/{id?}', [MatakuliahController::class, 'edit'])->name('edit_mk');
    Route::put('/mk/update/{id}', [MatakuliahController::class, 'update'])->name('update_mk');
    Route::delete('/mk/hapus/{id?}', [MatakuliahController::class, 'destroy'])->name('hapus_mk');

    Route::get('/bimbingan/dosen', [BimbinganController::class, 'index'])->name('daftar-bimbingan');
    Route::get('/bimbingan/dosen/{id?}', [BimbinganController::class, 'create'])->name('atur-bimbingan');
    Route::post('/simpan-bimbingan/{id}', [BimbinganController::class, 'store'])->name('simpan-bimbingan');
    Route::put('/bimbingan/update/{id}', [BimbinganController::class, 'update'])->name('update-bimbingan');
    Route::delete('/bimbingan/dosen/{dosen}/mahasiswa/{mahasiswa}', [BimbinganController::class, 'destroy'])->name('hapus-bimbingan');

    
});


Route::get('/test/{id}', function($id) {
    dd('Received ID: ' . $id);
});
/*
Route::get('/beranda', function(){
    return view('Halaman.Beranda');
})->middleware('auth:pengguna');
*/