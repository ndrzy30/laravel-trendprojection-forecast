<?php

namespace App\Imports;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportSales implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Transformasi tanggal
            $tanggal = isset($row['tanggal']) ? $this->transformDate($row['tanggal']) : null;

            // Logging hasil transformasi tanggal
            Log::info('Parsed date for sale:', ['tanggal' => $tanggal]);

            // Menyimpan data ke database
            Sale::create([
                'tanggal' => $tanggal,
                'obat' => $row['obat'],
                'jumlah' => $row['jumlah'],
            ]);
        }
    }

    /**
     * Mengubah format tanggal menjadi Y-m-d dengan logging tambahan untuk debugging.
     *
     * @param mixed $value
     * @return \Carbon\Carbon|null
     */
    private function transformDate($value)
    {
        Log::info('Original date value:', ['value' => $value]);

        // Jika nilai adalah instance DateTime
        if ($value instanceof \DateTime) {
            Log::info('Date is already an instance of DateTime:', ['date' => $value->format('Y-m-d')]);
            return $value->format('Y-m-d');
        }

        // Jika tanggal berupa angka serial Excel
        if (is_numeric($value)) {
            $date = Carbon::parse(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            Log::info('Date converted from Excel serial:', ['date' => $date->format('Y-m-d')]);
            return $date->format('Y-m-d');
        }

        // Proses tanggal jika dalam format string
        $formats = ['d/m/y', 'd-m-Y', 'Y-m-d', 'd/m/Y'];

        foreach ($formats as $format) {
            try {
                $date = Carbon::createFromFormat($format, $value);
                Log::info('Date matched with format:', ['format' => $format, 'date' => $date->format('Y-m-d')]);
                return $date->format('Y-m-d');
            } catch (\Exception $e) {
                Log::warning('Date format mismatch:', ['format' => $format, 'value' => $value]);
                continue;
            }
        }

        Log::error('No matching date format found', ['value' => $value]);
        return null;
    }
}
