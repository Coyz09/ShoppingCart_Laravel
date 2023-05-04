<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Customer;

class CustomerSheetImport implements ToModel,WithHeadingRow 
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        // dump($row);
        return new Customer([
            'title' => $row['title'],
            'fname' => $row['fname'],
            'lname' => $row['lname'],
            'addressline' => $row['addressline'],
			'town' => $row['town'],
            'zipcode' => $row['zipcode'],
            'phone' => $row['phone'],
            'user_id' => "6",

        ]);
    }
}
