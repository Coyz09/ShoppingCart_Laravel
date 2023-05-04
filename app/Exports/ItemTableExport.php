<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ItemTableExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function view(): View
    {
        return view('exports.items', [
            'items' => \App\Item::orderBy('item_id','ASC')->get()
        ]);
    }

}
