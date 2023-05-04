<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Item;

class ItemImport implements WithMultipleSheets, WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }

    public function sheets(): array
    {
        return [
            // 0 => new FirstSheetImport(),
             // 'Sheet1' => new FirstSheetImport(),
            'Tools' => new ToolsSheetImport(),
            // 'Customer' => new CustomerSheetImport(),
             ];
    }
}