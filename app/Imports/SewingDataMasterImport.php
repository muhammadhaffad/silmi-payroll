<?php

namespace App\Imports;

use App\Models\Tailor\Sewing;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SewingDataMasterImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Sewing::create([
                'nama' => $row['nama'] ?? 'UNKNOWN',
                'jahit' => $row['jahit'] ?? 0,
                'obras' => $row['obras'] ?? 0,
                'total' => $row['total'] ?? 0
            ]);
        }
    }
}
