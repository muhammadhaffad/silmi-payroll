<?php

namespace App\Models\Tailor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_tailor';
    protected $guarded = ['id'];

    public function infaq()
    {
        return $this->hasOne(Infaq::class);
    }
    public function installment()
    {
        return $this->hasOne(Installment::class);
    }
    public function trimming()
    {
        return $this->hasOne(Trimming::class);
    }
    public function sewingTasks()
    {
        return $this->hasMany(SewingTask::class);
    }
    public function sewingNeeds()
    {
        return $this->hasMany(SewingNeed::class);
    }
    public function sewingDefect()
    {
        return $this->hasOne(SewingDefect::class);
    }
    public function sewingCompensation()
    {
        return $this->hasOne(SewingCompensation::class);
    }
    public function sewingCompensationRules()
    {
        return $this->hasMany(SewingCompensationRule::class);
    }
}
