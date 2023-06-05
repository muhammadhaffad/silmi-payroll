<?php

namespace App\Models\Tailor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SewingNeed extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_tailor';
    protected $guarded = ['id'];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function sewingSupply()
    {
        return $this->belongsTo(SewingSupply::class);
    }
}
