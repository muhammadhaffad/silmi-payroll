<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FixedAllowanceController;
use App\Http\Controllers\MigrateDatabase;
use App\Http\Controllers\OvertimeRewardInstallmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\Tailor\EmployeeController as TailorEmployeeController;
use App\Http\Controllers\Tailor\EntrySalaryController;
use App\Http\Controllers\Tailor\SewingController;
use App\Http\Controllers\Tailor\SewingSupplyController;
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
    return redirect('gaji-pegawai/dashboard');
});

Route::get('/auth', function() {
    return view('auth.index');
});

Route::get('/home', function() {
    return view('home.index');
});
Route::prefix('/gaji-pegawai')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
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
        Route::get('lembur-reward-cicilan', [OvertimeRewardInstallmentController::class, 'index']);
        Route::post('lembur-reward-cicilan/upload-excel', [OvertimeRewardInstallmentController::class, 'uploadData']);
        /* Route::get('lembur-reward-cicilan/{nip}/edit', function ($nip) {
            return view('gaji-pegawai.lembur-reward-cicilan.edit');
        }); */
        Route::post('lembur-reward-cicilan/{nip}/remove', [OvertimeRewardInstallmentController::class, 'remove']);
        Route::post('lembur-reward-cicilan/remove-all', [OvertimeRewardInstallmentController::class, 'removeAll']);
        Route::get('tetap', [FixedAllowanceController::class, 'index']);
        Route::post('tetap/add', [FixedAllowanceController::class, 'addAllowance']);
        Route::get('tetap/{nip}/show', [FixedAllowanceController::class, 'show']);
        Route::get('tetap/{nip}/{tunjangan}/{id}/edit', [FixedAllowanceController::class, 'edit']);
        Route::put('tetap/{nip}/{tunjangan}/{id}/update', [FixedAllowanceController::class, 'update']);
        Route::post('tetap/{nip}/{tunjangan}/{id}/remove', [FixedAllowanceController::class, 'remove']);
        Route::get('tidak-tetap', [VariableAllowanceController::class, 'index']);
        Route::post('tidak-tetap/add', [VariableAllowanceController::class, 'addAllowance']);
        Route::get('tidak-tetap/{nip}/show', [VariableAllowanceController::class, 'showAttendance']);
        Route::post('tidak-tetap/upload', [VariableAllowanceController::class, 'uploadLog']);
        Route::put('tidak-tetap/{nip}/update', [VariableAllowanceController::class, 'update']);
        Route::get('tidak-tetap/{nip}/edit', [VariableAllowanceController::class, 'edit']);
        Route::get('tidak-tetap/{nip}/print', [VariableAllowanceController::class, 'downloadLog']);
        Route::post('tidak-tetap/{nip}/remove', [VariableAllowanceController::class, 'remove']);

    });
    Route::get('kartu-cicilan', [DebtController::class, 'index']);
    Route::post('kartu-cicilan/add', [DebtController::class, 'addDebt']);
    Route::post('kartu-cicilan/bayar-cicilan', [DebtController::class, 'payDebt']);
    Route::post('kartu-cicilan/hapus-cicilan/{id}', [DebtController::class, 'removeDebtPayment']);
    Route::post('kartu-cicilan/hapus-hutang/{id}', [DebtController::class, 'removeDebt']);
    Route::post('kartu-cicilan/download/{id}', [DebtController::class, 'printDebt']);
    Route::post('kartu-cicilan/download/image/{id}', [DebtController::class, 'copyDebt']);
    Route::get('gaji', [SalaryController::class, 'index']);
    Route::post('gaji/print/{nip}', [SalaryController::class, 'printSalaryPDF']);
    Route::post('gaji/gambar/{nip}', [SalaryController::class, 'printSalaryImage']);
    Route::post('gaji-perjam/gambar/{nip}', [SalaryController::class, 'printLog']);
    Route::get('akumulasi-gaji', function () {
        return view('gaji-pegawai.akumulasi.index');
    });
    Route::get('laporan', [ReportController::class, 'index']);
    Route::post('laporan/print-full', [ReportController::class, 'printFullReport']);
    Route::get('laporan/make-report', [ReportController::class, 'makeReport']);
});
Route::prefix('/gaji-penjahit')->group(function () {
    Route::get('/dashboard', function () {
        return view('gaji-penjahit.dashboard.index');
    });
    Route::prefix('/data-master')->group(function () {
        Route::get('jahit', [SewingController::class, 'index'])->name('data-master.jahit');
        Route::post('jahit/{id}/delete', [SewingController::class, 'delete'])->name('data-master.jahit.delete');
        Route::put('jahit/{id}/update', [SewingController::class, 'update'])->name('data-master.jahit.update');
        Route::post('jahit/create', [SewingController::class, 'create'])->name('data-master.jahit.create');
        Route::get('kebutuhan-jahit', [SewingSupplyController::class, 'index'])->name('data-master.kebutuhan-jahit');
        Route::post('kebutuhan-jahit/{id}/delete', [SewingSupplyController::class, 'delete'])->name('data-master.kebutuhan-jahit.delete');
        Route::post('kebutuhan-jahit/create', [SewingSupplyController::class, 'create'])->name('data-master.kebutuhan-jahit.create');
        Route::put('kebutuhan-jahit/{id}/update', [SewingSupplyController::class, 'update'])->name('data-master.kebutuhan-jahit.update');
        Route::get('karyawan', [TailorEmployeeController::class, 'index'])->name('data-master.karyawan');
        Route::put('karyawan/{id}/update', [TailorEmployeeController::class, 'update'])->name('data-master.karyawan.update');
        Route::post('karyawan/create', [TailorEmployeeController::class, 'create'])->name('data-master.karyawan.create');
    });
    Route::prefix('/pengaturan')->group(function () {
        Route::get('/kompensasi-kasus', function () {
            return view('gaji-penjahit.kompensasi-kasus.index');
        });
        Route::get('/kompensasi-total-jahit', function () {
            return view('gaji-penjahit.kompensasi-total-jahit.index');
        });
        Route::get('/kompensasi-total-jahit/{id}/edit', function ($id) {
            return view('gaji-penjahit.kompensasi-total-jahit.edit');
        });
    });
    Route::get('/entri-data-gaji', [EntrySalaryController::class, 'index']);
    Route::get('/entri-data-gaji/{id}/entri', function ($id) {
        return view('gaji-penjahit.entri-data-gaji.create');
    });
    Route::post('/entri-data-gaji/{id}/entri/tambah-jahit', [EntrySalaryController::class, 'addSewingTask'])->name('entri-data-gaji.tambah-jahit');
    Route::post('/entri-data-gaji/{id}/entri/cacat-jahit', [EntrySalaryController::class, 'addSewingDefect'])->name('entri-data-gaji.cacat-jahit');
    Route::post('/entri-data-gaji/{id}/entri/tambah-kebutuhan-jahit', [EntrySalaryController::class, 'addSewingNeed'])->name('entri-data-gaji.tambah-kebutuhan-jahit');
    Route::post('/entri-data-gaji/{id}/entri/simpan-bubut', [EntrySalaryController::class, 'saveTrimming'])->name('entri-data-gaji.simpan-bubut');
    Route::post('/entri-data-gaji/{id}/entri/simpan-cicilan', [EntrySalaryController::class, 'saveInstallment'])->name('entri-data-gaji.simpan-cicilan');
    Route::post('/entri-data-gaji/{id}/entri/simpan-infaq', [EntrySalaryController::class, 'saveInfaq'])->name('entri-data-gaji.simpan-infaq');
    Route::get('/gaji', function () {
        return view('gaji-penjahit.gaji.index');
    }); 
    Route::get('/laporan', function () {
        return view('gaji-penjahit.laporan.index');
    }); 
});
Route::get('test-export', [TestExcelController::class, 'export']);
Route::get('migrate', [MigrateDatabase::class, 'migrate']);