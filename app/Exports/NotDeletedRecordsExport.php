<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NotDeletedRecordsExport implements FromArray, WithHeadings
{
    protected $records;

    public function __construct(array $records)
    {
        $this->records = $records;
    }

    public function array(): array
    {
        $excelData = [];

        foreach ($this->records as $record) {
            $diferencias = json_encode($record['diferencias'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            $row = [
                '', // Deja la primera columna vacía
                $record['precinto'] ?? '',
                $record['primer_registro_id'] ?? '',
                $record['segundo_registro_id'] ?? '',
                $diferencias,
            ];

            $excelData[] = $row;
        }

        return $excelData;
    }

    public function headings(): array
    {
        return [
            '', // Primera columna vacía
            'Precinto',
            'ID Primer Registro',
            'ID Segundo Registro',
            'Diferencias',
        ];
    }
}
