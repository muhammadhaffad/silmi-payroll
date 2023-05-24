<?php

namespace App\Imports;

use App\Models\Installment;
use App\Models\Overtime;
use App\Models\Reward;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FixedAllowanceImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows) 
    {
        foreach ($rows as $row) {
            if (@$row['lembur']) {
                Overtime::create([
                    'employee_nip' => $row['id'],
                    'nama' => 'Lembur',
                    'jumlah' => $row['lembur']
                ]);
            }
            if (@$row['reward']) {
                Reward::create([
                    'employee_nip' => $row['id'],
                    'nama' => 'Reward',
                    'jumlah' => $row['reward'] 
                ]);
            }
            if (@$row['cicilan']) {
                Installment::create([
                    'employee_nip' => $row['id'],
                    'nama' => 'Cicilan',
                    'jumlah' => $row['cicilan']
                ]);
            }
        }
    }
}
