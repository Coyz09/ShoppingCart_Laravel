<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Item;

class PdfExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return Item::orderBy('item_id','DESC')->get();
    }

}
