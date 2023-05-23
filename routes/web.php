<?php

use App\Http\Controllers\DirectorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FixedAllowanceController;
use App\Http\Controllers\TestExcelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariableAllowanceController;
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
        Route::get('users', [UserController::class, 'index']);
        Route::post('users/{id}/change-password', [UserController::class, 'changePassword']);

        Route::get('direksi', [DirectorController::class, 'index']);
        Route::post('direksi/add', [DirectorController::class, 'store']);
        Route::get('direksi/{nip}/edit', [DirectorController::class, 'edit']);
        Route::put('direksi/{nip}/edit', [DirectorController::class, 'update']);
        Route::post('direksi/{id}/remove', [DirectorController::class, 'remove']);
        
        Route::get('karyawan', [EmployeeController::class, 'index']);
        Route::post('karyawan/add', [EmployeeController::class, 'store']);
        Route::get('karyawan/{nip}/edit', [EmployeeController::class, 'edit']);
        Route::put('karyawan/{nip}/update', [EmployeeController::class, 'update']);
        Route::post('karyawan/{nip}/remove', [EmployeeController::class, 'remove']);
        Route::post('karyawan/{nip}/ubah-tipe', [EmployeeController::class, 'toggleKhusus']);
        Route::post('karyawan/{nip}/ubah-status', [EmployeeController::class, 'toggleStatus']);
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
        Route::get('tetap', [FixedAllowanceController::class, 'index']);
        Route::post('tetap/add', [FixedAllowanceController::class, 'addAllowance']);
        Route::get('tetap/{nip}/show', [FixedAllowanceController::class, 'show']);
        Route::get('tetap/{nip}/{tunjangan}/{id}/edit', [FixedAllowanceController::class, 'edit']);
        Route::put('tetap/{nip}/{tunjangan}/{id}/update', [FixedAllowanceController::class, 'update']);
        Route::post('tetap/{nip}/{tunjangan}/{id}/remove', [FixedAllowanceController::class, 'remove']);
        Route::get('tidak-tetap', [VariableAllowanceController::class, 'index']);
        Route::post('tidak-tetap/add', [VariableAllowanceController::class, 'addAllowance']);
        Route::get('tidak-tetap/{nip}/show', function ($nip) {
            return view('gaji-pegawai.tunjangan-tidak-tetap.show');
        });
        Route::put('tidak-tetap/{nip}/update', [VariableAllowanceController::class, 'update']);
        Route::get('tidak-tetap/{nip}/edit', [VariableAllowanceController::class, 'edit']);
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
Route::get('test-export', [TestExcelController::class, 'export']);