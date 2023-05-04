<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Item;

class ItemExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Item::all();
    }
}
