<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HouseholdAllowance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_nip',
        'nama',
        'jumlah',
        'created_at',
        'updated_at'
    ];
}
