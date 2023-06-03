<?php
namespace App\Services\TailorCompensationSetting;

use App\Models\Tailor\Employee;
use App\Models\Tailor\SewingCompensationRule;
use App\Models\Tailor\SewingDefectRule;
use Illuminate\Support\Facades\Validator;

class CompensationSettingService
{
    public function getEmployeeCompensationSettings($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return [
                'code' => 404,
                'message' => 'Data karyawan tidak ada'
            ];
        }
        return [
            'code' => 200,
            'message' => 'Sukses mendapatkan data',
            'data' => $employee->load('sewingCompensationRules')
        ];
    }
    public function addCompensationRule($id, $attr)
    {
        $validator = Validator::make($attr, [
            'min_total_jahit' => 'required|numeric',
            'inclusive_min' => 'required|boolean',
            'inclusive_maks' => 'required|boolean',
            'maks_total_jahit' => 'required|numeric',
            'kompensasi_persen' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $employee = Employee::find($id);
        if (!$employee) {
            return [
                'code' => 404,
                'message' => 'Data karyawan tidak ada'
            ];
        }
        $rule = SewingCompensationRule::create([
            'employee_id' => $id,
            'min_total_jahit' => $attr['min_total_jahit'],
            'maks_total_jahit' => $attr['maks_total_jahit'],
            'inclusive_min' => $attr['inclusive_min'],
            'inclusive_maks' => $attr['inclusive_maks'],
            'kompensasi_persen' => $attr['kompensasi_persen']
        ]);
        if ($rule) {
            return [
                'code' => 201,
                'message' => 'Aturan berhasil ditambahkan',
                'data' => $rule
            ];
        }
    }
    public function updateCompensationRule($id, $attr)
    {
        $validator = Validator::make($attr, [
            'min_total_jahit' => 'required|numeric',
            'inclusive_min' => 'required|boolean',
            'inclusive_maks' => 'required|boolean',
            'maks_total_jahit' => 'required|numeric',
            'kompensasi_persen' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $rule = SewingCompensationRule::find($id)->update([
            'min_total_jahit' => $attr['min_total_jahit'],
            'maks_total_jahit' => $attr['maks_total_jahit'],
            'inclusive_min' => $attr['inclusive_min'],
            'inclusive_maks' => $attr['inclusive_maks'],
            'kompensasi_persen' => $attr['kompensasi_persen']
        ]);
        if ($rule) {
            return [
                'code' => 204,
                'message' => 'Aturan berhasil diupdate'
            ];
        } else {
            return [
                'code' => 404,
                'message' => 'Atruan tidak ditemukan'
            ];
        }
    }
    public function removeCompensationRule($id)
    {
        $rule = SewingCompensationRule::find($id)->delete();
        if ($rule) {
            return [
                'code' => 204,
                'message' => 'Aturan berhasil dihapus'
            ];
        } else {
            return [
                'code' => 404,
                'message' => 'Atruan tidak ditemukan'
            ];
        }
    }
    public function getDefectRule()
    {
        return [
            'code' => 200,
            'message' => 'Sukses mendapatkan data',
            'data' => SewingDefectRule::all()
        ];
    }
    public function addDefectRule($attr)
    {
        $validator = Validator::make($attr, [
            'min_cacat_persen' => 'required|numeric',
            'inclusive_min' => 'required|boolean',
            'inclusive_maks' => 'required|boolean',
            'maks_cacat_persen' => 'required|numeric',
            'kompensasi_persen' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $rule = SewingDefectRule::create([
            'min_cacat_persen' => $attr['min_cacat_persen'],
            'maks_cacat_persen' => $attr['maks_cacat_persen'],
            'inclusive_min' => $attr['inclusive_min'],
            'inclusive_maks' => $attr['inclusive_maks'],
            'kompensasi_persen' => $attr['kompensasi_persen']
        ]);
        if ($rule) {
            return [
                'code' => 201,
                'message' => 'Aturan berhasil ditambah',
                'data' => $rule
            ];
        }
    }
    public function updateDefectRule($id, $attr)
    {
        $validator = Validator::make($attr, [
            'min_cacat_persen' => 'required|numeric',
            'inclusive_min' => 'required|boolean',
            'inclusive_maks' => 'required|boolean',
            'maks_cacat_persen' => 'required|numeric',
            'kompensasi_persen' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $rule = SewingDefectRule::find($id)->update([
            'min_cacat_persen' => $attr['min_cacat_persen'],
            'maks_cacat_persen' => $attr['maks_cacat_persen'],
            'inclusive_min' => $attr['inclusive_min'],
            'inclusive_maks' => $attr['inclusive_maks'],
            'kompensasi_persen' => $attr['kompensasi_persen']
        ]);
        if ($rule) {
            return [
                'code' => 204,
                'message' => 'Aturan berhasil diupdate'
            ];
        } else {
            return [
                'code' => 404,
                'message' => 'Atruan tidak ditemukan'
            ];
        }
    }
    public function removeDefectRule($id)
    {
        $rule = SewingDefectRule::find($id)->delete();
        if ($rule) {
            return [
                'code' => 204,
                'message' => 'Aturan berhasil dihapus'
            ];
        } else {
            return [
                'code' => 404,
                'message' => 'Atruan tidak ditemukan'
            ];
        }
    }
}