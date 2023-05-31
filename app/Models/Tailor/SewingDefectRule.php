<?php

namespace App\Models\Tailor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* SELECT * FROM test WHERE (min_nilai <= 20 AND maks_nilai >= 20 AND inclusive_min = TRUE AND inclusive_max = TRUE) OR (min_nilai < 20 AND maks_nilai >= 20 AND inclusive_min = FALSE AND inclusive_max = TRUE) OR (min_nilai <= 20 AND maks_nilai > 20 AND inclusive_min = TRUE AND inclusive_max = FALSE) OR (min_nilai < 20 AND maks_nilai > 20 AND inclusive_min = FALSE AND inclusive_max = FALSE); */
class SewingDefectRule extends Model
{
    use HasFactory;
}
