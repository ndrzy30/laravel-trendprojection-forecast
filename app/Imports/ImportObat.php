<?php

namespace App\Imports;

use App\Models\Obat;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportObat implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Obat::create([
                'obat' => $row['obat'],
                'jenis' => $row['jenis'],
                'satuan' => $row['satuan'],
            ]);
        }
    }
}