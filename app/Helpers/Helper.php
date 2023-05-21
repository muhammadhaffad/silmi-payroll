<?php

namespace App\Helpers;

class Helper
{
    public static function rupiah($number) 
    {
        return 'Rp.'.number_format($number, 2, ',', '.');
    }
}
