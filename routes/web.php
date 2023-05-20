<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', function() {
    return view('auth.index');
});

Route::get('/home', function() {
    return view('home.index');
});
Route::prefix('/gaji-pegawai')->group(function () {
    Route::get('/dashboard', function() {
        return view('gaji-pegawai.dashboard.index');
    });
    Route::prefix('/data-master')->group(function () {
        Route::get('users', function () {
            return view('gaji-pegawai.user.index');
        });
        Route::get('users/{id}/change-password', function ($id) {
            return "User $id ganti password";
        });

        Route::get('direksi', function () {
            return view('gaji-pegawai.direksi.index');
        });
        Route::get('direksi/add', function () {
            return 'Direksi tambah';
        });
        Route::get('direksi/{id}/edit', function ($id) {
            return view('gaji-pegawai.direksi.edit');
        });
        Route::get('direksi/{id}/remove', function ($id) {
            return "Direksi $id hapus";
        });
        
        Route::get('karyawan', function () {
            return view('gaji-pegawai.karyawan.index');
        });
        Route::get('karyawan/add', function () {
            return 'Tambah Karyawan';
        });
        Route::get('karyawan/{id}/edit', function ($id) {
            return view('gaji-pegawai.karyawan.edit');
        });
        Route::get('karyawan/{id}/remove', function ($id) {
            return "Karyawan $id hapus";
        });
        Route::get('karyawan/{id}/ubah-tipe', function ($id) {
            return "Karyawan $id tipe diubah";
        });
        Route::get('karyawan/{id}/ubah-status', function ($id) {
            return "Karyawan $id status diubah";
        });
    });
    Route::prefix('/tunjangan')->group(function () {
        Route::get('lembur-sales', function () {
            return view('gaji-pegawai.lembur-per-jam.index');
        });
        Route::get('lembur-sales/add', function () {
            return 'Lembur Sales tambah';
        });
        Route::get('lembur-sales/{id}/edit', function ($id) {
            return view('gaji-pegawai.lembur-per-jam.edit');
        });
        Route::get('lembur-sales/{id}/remove', function ($id) {
            return 'Lembur Sales '.$id.' hapus';
        });
        Route::get('lembur-reward-cicilan', function () {
            return view('gaji-pegawai.lembur-reward-cicilan.index');
        });
        Route::get('lembur-reward-cicilan/upload-excel', function () {
            return 'Lembur reward Cicilan upload excel';
        });
        Route::get('lembur-reward-cicilan/{id}/edit', function ($id) {
            return view('gaji-pegawai.lembur-reward-cicilan.edit');
        });
        Route::get('lembur-reward-cicilan/{id}/remove', function ($id) {
            return 'Lembur reward Cicilan hapus ' . $id;
        });
        Route::get('tetap', function () {
            return 'Tunjangan tetap';
        });
        Route::get('tetap/add', function () {
            return 'Tunjangan tetap tambah';
        });
        Route::get('tetap/{id}/show', function ($id) {
            return 'Tunjangan tetap lihat';
        });
        Route::get('tidak-tetap', function () {
            return 'Tunjangan tidak tetap';
        });
        Route::get('tidak-tetap/add', function () {
            return 'Tunjangan tidak tetap tambah';
        });
        Route::get('tidak-tetap/{id}/show', function ($id) {
            return 'Tunjangan tidak tetap lihat ' . $id;
        });
        Route::get('tidak-tetap/{id}/edit', function ($id) {
            return 'Tunjangan tidak tetap edit ' . $id;
        });
        Route::get('tidak-tetap/{id}/remove', function ($id) {
            return 'Tunjangan tidak tetap hapus ' . $id;
        });
    });
    Route::get('kartu-cicilan', function () {
        return 'Kartu cicilan';
    });
    Route::get('kartu-cicilan/add', function () {
        return 'Kartu cicilan tambah';
    });
    Route::get('gaji', function () {
        return 'Take home/gaji';
    });
    Route::get('gaji/print', function () {
        return 'Take home/gaji print';
    });
    Route::get('akumulasi-gaji', function () {
        return 'Akumulasi gaji';
    });
    Route::get('laporan', function () {
        return 'Laporan';
    });
});