<?php
namespace App\Services\Allowance;

use App\Models\Employee;
use App\Models\ExpertiseAllowance;
use App\Models\HouseholdAllowance;
use App\Models\Infaq;
use App\Models\Installment;
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
            'rewards',
            'overtimes',
            'infaqs',
            'installments'
        ])
        ->loadSum('expertiseAllowances', 'jumlah')
        ->loadSum('householdAllowances', 'jumlah')
        ->loadSum('seniorityAllowances', 'jumlah')
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
}