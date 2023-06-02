<?php

namespace App\Models\Tailor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SewingTask extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_tailor';
    protected $guarded = ['id'];
}
