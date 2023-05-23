<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TestExcelController extends Controller
{
    public function export()
    {
        return Excel::download(new UserExport('Manajemen', 'Mei', 2023), 'users.pdf', \Maatwebsite\Excel\Excel::MPDF);
    }
}
