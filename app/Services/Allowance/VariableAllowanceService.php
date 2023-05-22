<?php
namespace App\Services\Allowance;

use App\Models\VariableAllowance;

class VariableAllowanceService
{
    public function getAllEmployeeAllowances()
    {
        $allowances = Employee::with('variableAllowance');
        return [
            'code' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $allowances
        ];
    }
    public function addAllowance($attr)
    {
        $validator = Validator::make($attr, [
            'nip' => 'required|numeric',
            'gaji_pokok' => 'required|numeric',
            'tunjangan_jabatan' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        if (VariableAllowance::where('employee_nip', $attr['nip'])->count() > 0) {
            return [
                'code' => 400,
                'message' => 'Karyawan sudah mempunyai tunjangan'
            ];
        }
        $allowance = VariableAllowance::create([
            'employee_nip' => $attr['nip'],
            'gaji_pokok' => $attr['gaji_pokok'],
            'tunjangan_jabatan' => $attr['tunjangan_jabatan'],
            'perjam' => ((int)$attr['gaji_pokok'] + (int)$attr['tunjangan_jabatan']) / 182 /* TODO: make trigger for this */
        ]);
        return [
            'code' => 200,
            'message' => 'Tunjangan berhasil ditambah',
            'data' => $allowance
        ];
    }
    public function updateAllowance($nip, $attr)
    {
        $validator = Validator::make($attr, [
            'gaji_pokok' => 'required|numeric',
            'tunjangan_jabatan' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        $allowance = VariableAllowance::where('nip', $nip)->first();
        $allowance->gaji_pokok = $attr['gaji_pokok'];
        $allowance->tunjangan_jabatan = $attr['tunjangan_jabatan'];
        $allowance->perjam = ((int)$attr['gaji_pokok'] + (int)$attr['tunjangan_jabatan']) / 182; /* TODO: make triggers for this */
        if ($allowance->save()) {
            return [
                'code' => 204,
                'message' => 'Tunjangan berhasil diubah'
            ];
        }
    }
    public function uploadWorkPresence()
    {
        return 'UPLOAD DATA EXCEL';
    }
    public function showWorkPresence($nip)
    {
        return 'TAMPILKAN DATA ABSEN KERJA '. $nip;
    }
}