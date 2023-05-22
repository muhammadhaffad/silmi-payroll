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
            'nama' => 'array',
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
        $attrMany = [];
        foreach ($attr['nama'] as $key => $nama) {
            $attrMany[] = [
                'nama' => $nama,
                'jumlah' => $attr['jumlah'][$key]
            ];
        }
        if ($attr['tunjangan'] === 'keahlian') {
            ExpertiseAllowance::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'kepala keluarga') {
            HouseholdAllowance::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'masa kerja') {
            SeniorityAllowance::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'reward') {
            Reward::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'lembur') {
            Overtime::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'infaq') {
            Infaq::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        } else if ($attr['tunjangan'] === 'cicilan') {
            Installment::insert($attrMany);
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil ditambah'
            ];
        }
        return [
            'code' => 404,
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
        ])->get();
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => $allowance
        ];
    }
}