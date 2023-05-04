<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\Search;
use App\Item;
use App\Customer;

class SearchController extends Controller
{
    public function search(Request $request)
    {
    	$searchResults = (new Search())

		   ->registerModel(Item::class, 'description','cost_price','sell_price')
		   ->registerModel(Customer::class, 'lname','fname','addressline','town')
		   ->search($request->input('search'));

	   // dd($searchResults);

	   return view('search',compact('searchResults'));
    }
}
