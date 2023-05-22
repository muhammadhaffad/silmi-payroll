<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nip',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'devisi',
        'jabatan',
        'tanggal_masuk',
        'alamat',
        'is_khusus',
        'status'
    ];
    public function variableAllowance()
    {
        return $this->hasOne(VariableAllowance::class, 'employee_nip', 'nip');
    }
    public function expertiseAllowances()
    {
        return $this->hasMany(ExpertiseAllowance::class, 'employee_nip', 'nip');
    }
    public function householdAllowances()
    {
        return $this->hasMany(HouseholdAllowance::class, 'employee_nip', 'nip');
    }
    public function seniorityAllowances()
    {
        return $this->hasMany(SeniorityAllowance::class, 'employee_nip', 'nip');
    }
    public function rewards()
    {
        return $this->hasMany(Reward::class, 'employee_nip', 'nip');
    }
    public function overtimes()
    {
        return $this->hasMany(Overtime::class, 'employee_nip', 'nip');
    }
    public function infaqs()
    {
        return $this->hasMany(Infaq::class, 'employee_nip', 'nip');
    }
    public function installments()
    {
        return $this->hasMany(Installment::class, 'employee_nip', 'nip');
    }
}
