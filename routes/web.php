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
        Route::get('users/{nip}/change-password', function ($nip) {
            return "User $nip ganti password";
        });

        Route::get('direksi', function () {
            return view('gaji-pegawai.direksi.index');
        });
        Route::get('direksi/add', function () {
            return 'Direksi tambah';
        });
        Route::get('direksi/{nip}/edit', function ($nip) {
            return view('gaji-pegawai.direksi.edit');
        });
        Route::get('direksi/{nip}/remove', function ($nip) {
            return "Direksi $nip hapus";
        });
        
        Route::get('karyawan', function () {
            return view('gaji-pegawai.karyawan.index');
        });
        Route::get('karyawan/add', function () {
            return 'Tambah Karyawan';
        });
        Route::get('karyawan/{nip}/edit', function ($nip) {
            return view('gaji-pegawai.karyawan.edit');
        });
        Route::get('karyawan/{nip}/remove', function ($nip) {
            return "Karyawan $nip hapus";
        });
        Route::get('karyawan/{nip}/ubah-tipe', function ($nip) {
            return "Karyawan $nip tipe diubah";
        });
        Route::get('karyawan/{nip}/ubah-status', function ($nip) {
            return "Karyawan $nip status diubah";
        });
    });
    Route::prefix('/tunjangan')->group(function () {
        Route::get('lembur-sales', function () {
            return view('gaji-pegawai.lembur-per-jam.index');
        });
        Route::get('lembur-sales/add', function () {
            return 'Lembur Sales tambah';
        });
        Route::get('lembur-sales/{nip}/edit', function ($nip) {
            return view('gaji-pegawai.lembur-per-jam.edit');
        });
        Route::get('lembur-sales/{nip}/remove', function ($nip) {
            return 'Lembur Sales '.$nip.' hapus';
        });
        Route::get('lembur-reward-cicilan', function () {
            return view('gaji-pegawai.lembur-reward-cicilan.index');
        });
        Route::get('lembur-reward-cicilan/upload-excel', function () {
            return 'Lembur reward Cicilan upload excel';
        });
        Route::get('lembur-reward-cicilan/{nip}/edit', function ($nip) {
            return view('gaji-pegawai.lembur-reward-cicilan.edit');
        });
        Route::get('lembur-reward-cicilan/{nip}/remove', function ($nip) {
            return 'Lembur reward Cicilan hapus ' . $nip;
        });
        Route::get('tetap', function () {
            return view('gaji-pegawai.tunjangan-tetap.index');
        });
        Route::get('tetap/add', function () {
            return 'Tunjangan tetap tambah';
        });
        Route::get('tetap/{nip}/show', function ($nip) {
            return view('gaji-pegawai.tunjangan-tetap.show');
        });
        Route::get('tetap/{nip}/{tunjangan}/{id}/edit', function ($nip, $tunjangan, $id) {
            switch ($tunjangan) {
                case 'keahlian':
                    return view('gaji-pegawai.tunjangan-tetap.edit', ['tunjangan' => 'Tunjangan Keahlian']);
                    break;
                case 'kepala-keluarga':
                    return view('gaji-pegawai.tunjangan-tetap.edit', ['tunjangan' => 'Tunjangan Kepala Keluarga']);
                    break;
                case 'masa-kerja':
                    return view('gaji-pegawai.tunjangan-tetap.edit', ['tunjangan' => 'Tunjangan Masa Kerja']);
                    break;
                case 'reward':
                    return view('gaji-pegawai.tunjangan-tetap.edit', ['tunjangan' => 'Tunjangan Reward']);
                    break;
                case 'lembur':
                    return view('gaji-pegawai.tunjangan-tetap.edit', ['tunjangan' => 'Tunjangan Lembur']);
                    break;
                case 'infaq':
                    return view('gaji-pegawai.tunjangan-tetap.edit', ['tunjangan' => 'Infaq']);
                    break;
                case 'cicilan':
                    return view('gaji-pegawai.tunjangan-tetap.edit', ['tunjangan' => 'Cicilan']);
                    break;
                default:
                    return abort(404);
                    break;
            }
        });
        Route::get('tidak-tetap', function () {
            return view('gaji-pegawai.tunjangan-tidak-tetap.index');
        });
        Route::get('tidak-tetap/add', function () {
            return 'Tunjangan tidak tetap tambah';
        });
        Route::get('tidak-tetap/{nip}/show', function ($nip) {
            return view('gaji-pegawai.tunjangan-tidak-tetap.show');
        });
        Route::get('tidak-tetap/{nip}/edit', function ($nip) {
            return view('gaji-pegawai.tunjangan-tidak-tetap.edit');
        });
        Route::get('tidak-tetap/{nip}/remove', function ($nip) {
            return 'Tunjangan tidak tetap hapus ' . $nip;
        });
    });
    Route::get('kartu-cicilan', function () {
        return view('gaji-pegawai.kartu-cicilan.index');
    });
    Route::get('kartu-cicilan/add', function () {
        return 'Kartu cicilan tambah';
    });
    Route::get('gaji', function () {
        return view('gaji-pegawai.gaji.index');
    });
    Route::get('gaji/print', function () {
        return 'Take home/gaji print';
    });
    Route::get('akumulasi-gaji', function () {
        return view('gaji-pegawai.akumulasi.index');
    });
    Route::get('laporan', function () {
        return view('gaji-pegawai.laporan.index');
    });
});