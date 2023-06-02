<?php
namespace App\Services\TailorEntrySalary;

use App\Models\Tailor\Employee;
use App\Models\Tailor\Infaq;
use App\Models\Tailor\Installment;
use App\Models\Tailor\SewingDefect;
use App\Models\Tailor\SewingNeed;
use App\Models\Tailor\SewingTask;
use App\Models\Tailor\Trimming;
use Illuminate\Support\Facades\Validator;

class EntrySalaryService
{
    public function getAllEmployeeSalaries()
    {
        return [
            'code' => 200,
            'message' => 'Sukses berhasil data',
            'data' => Employee::query()->withSum('sewingTasks', 'total')
                ->withSum('sewingNeeds', 'total')
                ->with(['sewingCompensation', 'sewingDefect', 'installment', 'infaq', 'trimming'])->get()
        ];
    }
    public function getSalaryEmployee($id)
    {
        return [
            'code' => 200,
            'message' => 'Sukses mendapatkan data',
            'data' => Employee::find($id)->load(['sewingTasks', 'sewingCompensation', 'sewingDefect', 'sewingNeeds', 'trimming', 'installment', 'infaq'])
        ];
    }
    public function addSewingTask($id, $attr)
    {
        $validator = Validator::make($attr, [
            'sewing_id' => 'required|numeric',
            'qty' => 'required|numeric' 
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
                'message' => 'Karyawan tidak ditemukan'
            ];
        }
        $sewingTask = SewingTask::create([
            'employee_id' => $id,
            'sewing_id' => $attr['sewing_id'],
            'qty' => $attr['qty']
        ]);
        return [
            'code' => 200,
            'message' => 'Tugas jahit berhasil ditambahkan',
            'data' => $sewingTask
        ];
    }
    public function updateSewingTask($id, $attr)
    {
        $validator = Validator::make($attr, [
            'sewing_id' => 'required|numeric',
            'qty' => 'required|numeric' 
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $update = SewingTask::find($id)->update([
            'sewing_id' => $attr['sewing_id'],
            'qty' => $attr['qty']
        ]);
        if ($update) {
            return [
                'code' => 204,
                'message' => 'Tugas jahit berhasil diupdate'
            ];
        } else {
            return [
                'code' => 404,
                'message' => 'Tugas jahit tidak ditemukan'
            ];
        }
    }
    public function removeSewingTask($id)
    {
        $delete = SewingTask::find($id)->delete();
        if ($delete) {
            return [
                'code' => 204,
                'message' => 'Tugas jahit berhasil dihapus'
            ];
        } else {
            return [
                'code' => 404,
                'message' => 'Tugas jahit tidak ditemukan'
            ];
        }
    }
    public function addSewingNeed($id, $attr)
    {
        $validator = Validator::make($attr, [
            'sewing_supply_id' => 'required|numeric',
            'qty' => 'required|numeric' 
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
                'message' => 'Karyawan tidak ditemukan'
            ];
        }
        $sewingNeed = SewingNeed::create([
            'employee_id' => $id,
            'sewing_supply_id' => $attr['sewing_supply_id'],
            'qty' => $attr['qty']
        ]);
        return [
            'code' => 200,
            'message' => 'Tugas jahit berhasil ditambahkan',
            'data' => $sewingNeed
        ];
    }
    public function updateSewingNeed($id, $attr)
    {
        $validator = Validator::make($attr, [
            'sewing_supply_id' => 'required|numeric',
            'qty' => 'required|numeric' 
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $update = SewingNeed::find($id)->update([
            'sewing_supply_id' => $attr['sewing_supply_id'],
            'qty' => $attr['qty']
        ]);
        if ($update) {
            return [
                'code' => 204,
                'message' => 'Kebutuhan jahit berhasil diupdate'
            ];
        } else {
            return [
                'code' => 404,
                'message' => 'Kebutuhan jahit tidak ditemukan'
            ];
        }
    }
    public function removeSewingNeed($id)
    {
        $delete = SewingNeed::find($id)->delete();
        if ($delete) {
            return [
                'code' => 204,
                'message' => 'Kebutuhan jahit berhasil dihapus'
            ];
        } else {
            return [
                'code' => 404,
                'message' => 'Kebutuhan jahit tidak ditemukan'
            ];
        }
    }
    public function addOrUpdateDefect($id, $attr)
    {
        $validator = Validator::make($attr, [
            'cacat_persen' => 'required|numeric' 
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
                'message' => 'Karyawan tidak ditemukan'
            ];
        }
        SewingDefect::updateOrCreate(['employee_id' => $id],[
            'cacat_persen' => $attr['cacat_persen']
        ]);
        return [
            'code' => 204,
            'message' => 'Cacat berhasil ditambah/diupdate'
        ];
    }
    public function updateTrimming($id, $attr)
    {
        $validator = Validator::make($attr, [
            'jumlah' => 'required|numeric' 
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
                'message' => 'Karyawan tidak ditemukan'
            ];
        }
        Trimming::updateOrCreate(['employee_id' => $id],[
            'cacat_persen' => $attr['cacat_persen']
        ]);
        return [
            'code' => 204,
            'message' => 'Bubut berhasil ditambah/diupdate'
        ];
    }
    public function updateInstallment($id, $attr)
    {
        $validator = Validator::make($attr, [
            'jumlah' => 'required|numeric' 
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
                'message' => 'Karyawan tidak ditemukan'
            ];
        }
        Installment::updateOrCreate(['employee_id' => $id],[
            'jumlah' => $attr['jumlah']
        ]);
        return [
            'code' => 204,
            'message' => 'Bubut berhasil ditambah/diupdate'
        ];
    }
    public function updateInfaq($id, $attr)
    {
        $validator = Validator::make($attr, [
            'jumlah' => 'required|numeric' 
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
                'message' => 'Karyawan tidak ditemukan'
            ];
        }
        Infaq::updateOrCreate(['employee_id' => $id],[
            'jumlah' => $attr['jumlah']
        ]);
        return [
            'code' => 204,
            'message' => 'Infaq berhasil ditambah/diupdate'
        ];
    }
}