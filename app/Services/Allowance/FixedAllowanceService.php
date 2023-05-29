<?php
namespace App\Services\Allowance;

use App\Models\Employee;
use App\Models\EtcAllowance;
use App\Models\ExpertiseAllowance;
use App\Models\HouseholdAllowance;
use App\Models\Infaq;
use App\Models\Installment;
use App\Models\OperationalAllowance;
use App\Models\Overtime;
use App\Models\Reward;
use App\Models\SeniorityAllowance;
use Illuminate\Support\Facades\Validator;

class FixedAllowanceService
{
    public function getAllEmployeeAllowances()
    {
        $allowances = Employee::withSum('expertiseAllowances', 'jumlah')
            ->withSum('householdAllowances', 'jumlah')
            ->withSum('seniorityAllowances', 'jumlah')
            ->withSum('operationalAllowances', 'jumlah')
            ->withSum('etcAllowances', 'jumlah')
            ->withSum('rewards', 'jumlah')
            ->withSum('overtimes', 'jumlah')
            ->withSum('infaqs', 'jumlah')
            ->withSum('installments', 'jumlah')
            ->get();
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => $allowances
        ];
    }
    public function getAllEmployeeSomeAllowances($relations)
    {
        $employees = Employee::query();
        foreach ($relations as $relation) {
            $employees->withSum($relation, 'jumlah');
        }
        $employees = $employees->get();
        return [
            'code' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $employees
        ];
    }
    /* public function getEmployeeSomeAllowances($nip, $relations)
    {
        $employee = Employee::where('nip', $nip)->first();
        foreach ($relations as $relation) {
            $employee->with($relation);
        }
        $employees = $employees->get();
        return [
            'code' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $employees
        ];
    } */
    public function addAllowance($attr)
    {
        $validator = Validator::make($attr, [
            'nip' => 'required|numeric',
            'tunjangan' => 'required',
            'nama' => 'sometimes|array',
            'nama.*' => 'sometimes|string',
            'jumlah' => 'array',
            'jumlah.*' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        if ($attr['tunjangan'] === 'keahlian') {
            $attrMany = [];
            foreach ($attr['nama'] as $key => $nama) {
                $attrMany[] = [
                    'employee_nip' => $attr['nip'],
                    'nama' => $nama,
                    'jumlah' => $attr['jumlah'][$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            ExpertiseAllowance::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'kepala-keluarga') {
            $attrMany = [];
            foreach ($attr['jumlah'] as $jumlah) {
                $attrMany[] = [
                    'employee_nip' => $attr['nip'],
                    'nama' => 'Kepala Keluarga',
                    'jumlah' => $jumlah,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            HouseholdAllowance::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'masa-kerja') {
            $attrMany = [];
            foreach ($attr['jumlah'] as $jumlah) {
                $attrMany[] = [
                    'employee_nip' => $attr['nip'],
                    'nama' => 'Masa Kerja',
                    'jumlah' => $jumlah,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            SeniorityAllowance::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'operasional') {
            $attrMany = [];
            foreach ($attr['jumlah'] as $jumlah) {
                $attrMany[] = [
                    'employee_nip' => $attr['nip'],
                    'nama' => 'Operasional',
                    'jumlah' => $jumlah,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            OperationalAllowance::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'lain-lain') {
            $attrMany = [];
            foreach ($attr['jumlah'] as $jumlah) {
                $attrMany[] = [
                    'employee_nip' => $attr['nip'],
                    'nama' => 'Lain-lain',
                    'jumlah' => $jumlah,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            EtcAllowance::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'reward') {
            $attrMany = [];
            foreach ($attr['jumlah'] as $jumlah) {
                $attrMany[] = [
                    'employee_nip' => $attr['nip'],
                    'nama' => 'Reward',
                    'jumlah' => $jumlah,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            Reward::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'lembur') {
            $attrMany = [];
            foreach ($attr['jumlah'] as $jumlah) {
                $attrMany[] = [
                    'employee_nip' => $attr['nip'],
                    'nama' => 'Lembur',
                    'jumlah' => $jumlah,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            Overtime::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'infaq') {
            $attrMany = [];
            foreach ($attr['jumlah'] as $jumlah) {
                $attrMany[] = [
                    'employee_nip' => $attr['nip'],
                    'nama' => 'Infaq',
                    'jumlah' => $jumlah,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            Infaq::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'cicilan') {
            $attrMany = [];
            foreach ($attr['jumlah'] as $jumlah) {
                $attrMany[] = [
                    'employee_nip' => $attr['nip'],
                    'nama' => 'Cicilan',
                    'jumlah' => $jumlah,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            Installment::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        }
        return [
            'code' => 400,
            'message' => 'Tunjangan tidak valid ngab'
        ]; 
    }
    public function getEmployeeAllowance($nip)
    {
        $allowance = Employee::where('nip', $nip)->first();
        $allowance = $allowance->load([
            'expertiseAllowances', 
            'householdAllowances', 
            'seniorityAllowances', 
            'operationalAllowances', 
            'etcAllowances', 
            'rewards',
            'overtimes',
            'infaqs',
            'installments'
        ])
        ->loadSum('expertiseAllowances', 'jumlah')
        ->loadSum('householdAllowances', 'jumlah')
        ->loadSum('seniorityAllowances', 'jumlah')
        ->loadSum('operationalAllowances', 'jumlah')
        ->loadSum('etcAllowances', 'jumlah')
        ->loadSum('rewards', 'jumlah')
        ->loadSum('overtimes', 'jumlah')
        ->loadSum('infaqs', 'jumlah')
        ->loadSum('installments', 'jumlah');
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => $allowance
        ];
    }
    public function show($nip, $tunjangan, $id)
    {
        if ($tunjangan == 'keahlian')
            return [
                'code' => 200,
                'message' => 'Data berhasil didapatkan',
                'data' => ExpertiseAllowance::where('employee_nip', $nip)->where('id', $id)->first()
            ];
        if ($tunjangan == 'kepala-keluarga')
            return [
                'code' => 200,
                'message' => 'Data berhasil didapatkan',
                'data' => HouseholdAllowance::where('employee_nip', $nip)->where('id', $id)->first()
            ];
        if ($tunjangan == 'masa-kerja')
            return [
                'code' => 200,
                'message' => 'Data berhasil didapatkan',
                'data' => SeniorityAllowance::where('employee_nip', $nip)->where('id', $id)->first()
            ];
        if ($tunjangan == 'operasional')
            return [
                'code' => 200,
                'message' => 'Data berhasil didapatkan',
                'data' => OperationalAllowance::where('employee_nip', $nip)->where('id', $id)->first()
            ];
        if ($tunjangan == 'lain-lain')
            return [
                'code' => 200,
                'message' => 'Data berhasil didapatkan',
                'data' => EtcAllowance::where('employee_nip', $nip)->where('id', $id)->first()
            ];
        if ($tunjangan == 'reward')
            return [
                'code' => 200,
                'message' => 'Data berhasil didapatkan',
                'data' => Reward::where('employee_nip', $nip)->where('id', $id)->first()
            ];
        if ($tunjangan == 'lembur')
            return [
                'code' => 200,
                'message' => 'Data berhasil didapatkan',
                'data' => Overtime::where('employee_nip', $nip)->where('id', $id)->first()
            ];
        if ($tunjangan == 'infaq')
            return [
                'code' => 200,
                'message' => 'Data berhasil didapatkan',
                'data' => Infaq::where('employee_nip', $nip)->where('id', $id)->first()
            ];
        if ($tunjangan == 'cicilan')
            return [
                'code' => 200,
                'message' => 'Data berhasil didapatkan',
                'data' => Installment::where('employee_nip', $nip)->where('id', $id)->first()
            ];
        return [
            'code' => 400,
            'message' => 'Tunjangan tidak valid ngab'
        ];
    }
    public function updateAllowance($nip, $tunjangan, $id, $attr)
    {
        $validator = Validator::make($attr, [
            'nama' => 'sometimes|string',
            'jumlah' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data $tunjangan yang diberikan tidak valid",
                'errros' => $validator->errors()
            ];
        }
        if ($tunjangan == 'keahlian') {
            $allowance = ExpertiseAllowance::where('employee_nip', $nip)->where('id', $id)->first();
            $allowance->nama = $attr['nama'];
            $allowance->jumlah = $attr['jumlah'];
            if ($allowance->save()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil diupdate'
                ];
            }
        }
        if ($tunjangan == 'kepala-keluarga') {
            $allowance = HouseholdAllowance::where('employee_nip', $nip)->where('id', $id)->first();
            $allowance->jumlah = $attr['jumlah'];
            if ($allowance->save()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil diupdate'
                ];
            }
        }
        if ($tunjangan == 'masa-kerja') {
            $allowance = SeniorityAllowance::where('employee_nip', $nip)->where('id', $id)->first();
            $allowance->jumlah = $attr['jumlah'];
            if ($allowance->save()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil diupdate'
                ];
            }
        }
        if ($tunjangan == 'operasional') {
            $allowance = OperationalAllowance::where('employee_nip', $nip)->where('id', $id)->first();
            $allowance->jumlah = $attr['jumlah'];
            if ($allowance->save()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil diupdate'
                ];
            }
        }
        if ($tunjangan == 'lain-lain') {
            $allowance = EtcAllowance::where('employee_nip', $nip)->where('id', $id)->first();
            $allowance->jumlah = $attr['jumlah'];
            if ($allowance->save()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil diupdate'
                ];
            }
        }
        if ($tunjangan == 'reward') {
            $allowance = Reward::where('employee_nip', $nip)->where('id', $id)->first();
            $allowance->jumlah = $attr['jumlah'];
            if ($allowance->save()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil diupdate'
                ];
            }
        }
        if ($tunjangan == 'lembur') {
            $allowance = Overtime::where('employee_nip', $nip)->where('id', $id)->first();
            $allowance->jumlah = $attr['jumlah'];
            if ($allowance->save()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil diupdate'
                ];
            }
        }
        if ($tunjangan == 'infaq') {
            $allowance = Infaq::where('employee_nip', $nip)->where('id', $id)->first();
            $allowance->jumlah = $attr['jumlah'];
            if ($allowance->save()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil diupdate'
                ];
            }
        }
        if ($tunjangan == 'cicilan') {
            $allowance = Installment::where('employee_nip', $nip)->where('id', $id)->first();
            $allowance->jumlah = $attr['jumlah'];
            if ($allowance->save()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil diupdate'
                ];
            }
        }
        return [
            'code' => 400,
            'message' => 'Tunjangan tidak valid ngab'
        ];
    }
    public function deleteAllowance($nip, $tunjangan, $id)
    {
        if ($tunjangan == 'keahlian') {
            $allowance = ExpertiseAllowance::where('employee_nip', $nip)->where('id', $id)->first();
            if ($allowance->delete()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil dihapus'
                ];
            }
        }
        if ($tunjangan == 'kepala-keluarga') {
            $allowance = HouseholdAllowance::where('employee_nip', $nip)->where('id', $id)->first();
            if ($allowance->delete()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil dihapus'
                ];
            }
        }
        if ($tunjangan == 'masa-kerja') {
            $allowance = SeniorityAllowance::where('employee_nip', $nip)->where('id', $id)->first();
            if ($allowance->delete()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil dihapus'
                ];
            }
        }
        if ($tunjangan == 'operasional') {
            $allowance = OperationalAllowance::where('employee_nip', $nip)->where('id', $id)->first();
            if ($allowance->delete()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil dihapus'
                ];
            }
        }
        if ($tunjangan == 'lain-lain') {
            $allowance = EtcAllowance::where('employee_nip', $nip)->where('id', $id)->first();
            if ($allowance->delete()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil dihapus'
                ];
            }
        }
        if ($tunjangan == 'reward') {
            $allowance = Reward::where('employee_nip', $nip)->where('id', $id)->first();
            if ($allowance->delete()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil dihapus'
                ];
            }
        }
        if ($tunjangan == 'lembur') {
            $allowance = Overtime::where('employee_nip', $nip)->where('id', $id)->first();
            if ($allowance->delete()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil dihapus'
                ];
            }
        }
        if ($tunjangan == 'infaq') {
            $allowance = Infaq::where('employee_nip', $nip)->where('id', $id)->first();
            if ($allowance->delete()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil dihapus'
                ];
            }
        }
        if ($tunjangan == 'cicilan') {
            $allowance = Installment::where('employee_nip', $nip)->where('id', $id)->first();
            if ($allowance->delete()) {
                return [
                    'code' => 204,
                    'message' => 'Data berhasil dihapus'
                ];
            }
        }
        return [
            'code' => 400,
            'message' => 'Tunjangan tidak valid ngab'
        ];
    }
    public function deleteSomeAllowances($nip, $relations)
    {
        $employee = Employee::where('nip', $nip)->first();
        foreach ($relations as $realtion) {
            $employee->{$realtion}()->delete();
        }
        return [
            'code' => 204,
            'message' => 'Data berhasil dihapus'
        ];
    }
    public function deleteAllEmployeeSomeAllowances($models)
    {
        foreach ($models as $model) {
            $class = "App\Models\\$model";
            $class::whereNull('deleted_at')->delete();
        }
        return [
            'code' => 204,
            'message' => 'Semua Data berhasil dihapus'
        ];
    }
}