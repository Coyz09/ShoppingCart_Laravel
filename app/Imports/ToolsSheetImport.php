<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Item;

class ToolsSheetImport implements ToModel,WithHeadingRow 
{
    /**
    * @param Collection $collection
    */
     public function model(array $row)
    {
        // dump($row);
        return new Item([
            'description' => $row['item_name'],
            'cost_price' => $row['cost_price'],
            'sell_price' => $row['sell_price'],
            'img_path'=> "item",
        ]);
    }
}
