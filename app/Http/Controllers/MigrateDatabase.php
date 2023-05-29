<?php

namespace App\Http\Controllers;

use App\Models\DebtPayment;
use App\Models\Employee;
use App\Models\ExpertiseAllowance;
use App\Models\HouseholdAllowance;
use App\Models\Infaq;
use App\Models\SeniorityAllowance;
use App\Models\VariableAllowance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MigrateDatabase extends Controller
{
    public function migrate()
    {
        // $datas = DB::connection('mysql2')->table('cicilan_hutang')->get();
        // foreach ($datas as $key => $data) {
        //     DebtPayment::create([
        //         'employee_nip' => $data->nip,
        //         'debt_id' => 2,
        //         'tanggal' => $data->tanggal_input,
        //         'cicilan' => $data->cicilan_hutang
        //     ]);
        // }
        $datas = Employee::withSum(['attendanceLogs' => function($q) {
            $q->where('tanggal_expired', '>=', date('Y-m-d'));
        }], 'total_jam')->where('devision_id', 1)->get();
        return $datas;
    }
}
