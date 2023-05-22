<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariableAllowance extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'employee_nip',
        'gaji_pokok',
        'tunjangan_jabatan',
        'perjam'
    ];
}
