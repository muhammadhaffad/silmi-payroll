<?php
namespace App\Services\Employee;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeService
{
    public function getAllEmployees()
    {
        return [
            'code' => 200,
            'message' => 'Data berhasil didapatkan',
            'data' => Employee::withoutGlobalScope('activeEmployee')->get()->all()
        ];
    }
    public function getEmployee($nip)
    {
        return [
            'code' => 200,
            'message'=> 'Data berhasil didapatkan',
            'data' => Employee::withoutGlobalScope('activeEmployee')->where('nip', $nip)->first()
        ];
    }
    public function countGenderEmployee()
    {
        $gender = Employee::select('jenis_kelamin', DB::raw('COUNT(*) AS jumlah'))->groupBy('jenis_kelamin')->get();
        return [
            'code' => 200,
            'message' => 'Sukses mendapatkan data',
            'data' => $gender
        ];
    }
    public function addEmployee($attr)
    {
        $validator = Validator::make($attr, [
            'nip' => 'required|numeric',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'devision_id' => 'required',
            'jabatan' => 'required',
            'tanggal_masuk' => 'required|date',
            'alamat' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        $employee = Employee::create([
            'nip' => $attr['nip'],
            'nama' => $attr['nama'],
            'jenis_kelamin' => $attr['jenis_kelamin'],
            'tanggal_lahir' => $attr['tanggal_lahir'],
            'devision_id' => $attr['devision_id'],
            'jabatan' => $attr['jabatan'],
            'tanggal_masuk' => $attr['tanggal_masuk'],
            'alamat' => $attr['alamat'],
            'is_khusus' => false,
            'status' => true
        ]);
        return [
            'code' => 201,
            'message' => 'Karyawan berhasil ditambah',
            'data' => $employee
        ];
    }
    public function updateEmployee($nip, $attr)
    {
        $validator = Validator::make($attr, [
            'nip' => 'required|numeric',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'devisi' => 'required',
            'jabatan' => 'required',
            'tanggal_masuk' => 'required|date',
            'alamat' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => "Data yang diberikan tidak valid",
                'errors' => $validator->errors()
            ];
        }
        $employee = Employee::withoutGlobalScope('activeEmployee')->where('nip', $nip)->first();
        $employee->nip = $attr['nip'];
        $employee->nama = $attr['nama'];
        $employee->jenis_kelamin = $attr['jenis_kelamin'];
        $employee->tanggal_lahir = $attr['tanggal_lahir'];
        $employee->devision_id = $attr['devision_id'];
        $employee->jabatan = $attr['jabatan'];
        $employee->tanggal_masuk = $attr['tanggal_masuk'];
        $employee->alamat = $attr['alamat'];
        if ($employee->save()) {
            return [
                'code' => 204,
                'message' => 'Data karyawan berhasil diubah'
            ];
        }
    }
    public function deleteEmployee($nip)
    {
        $employee = Employee::where('nip', $nip)->first();
        if ($employee->delete()) {
            return [
                'code' => 204,
                'message' => 'Data karyawan berhasil dihapus',
            ];
        }
    }
    public function toggleKhusus($nip)
    {
        $employee = Employee::where('nip', $nip)->first();
        if ($employee->is_khusus) {
            $employee->is_khusus = false;
        } else {
            $employee->is_khusus = true;
        }
        if ($employee->save()) {
            return [
                'code' => 204,
                'message' => 'Tipe karyawan berhasil diubah'
            ];
        }
    }
    public function toggleStatus($nip)
    {
        $employee = Employee::withoutGlobalScope('activeEmployee')->where('nip', $nip)->first();
        if ($employee->status) {
            $employee->status = false;
        } else {
            $employee->status = true;
        }
        if ($employee->save()) {
            return [
                'code' => 204,
                'message' => 'Status karyawan berhasil diubah'
            ];
        }
    }
}