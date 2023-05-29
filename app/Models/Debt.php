<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debt extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [
        'id'
    ];
    public function debtPayments()
    {
        return $this->hasMany(DebtPayment::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_nip', 'nip');
    }
}
