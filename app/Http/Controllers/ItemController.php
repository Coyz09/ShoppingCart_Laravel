<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Redirect;
use View;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;
use App\Rules\ExcelRule;
use App\Exports\ItemExport;
use App\Exports\ItemTableExport;
use App\Exports\PDFExport;
use Yajra\Datatables\Datatables;
use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { // {,compact('items')
        // $items = Item::all();
        // $items = Item::paginate(5);
        // $items = Item::orderBy('item_id','ASC')->paginate(5);

        return view('item.index');
    }

    public function getItem(){
        $items = Item::select('item_id','description','sell_price','cost_price');

        $customer_orderinfo = DB::table('customer')
            ->leftJoin('orderinfo','orderinfo.customer_id','=','customer.customer_id')
            ->select('orderinfo_id','fname','date_placed')
            ->get(); 
        // dd( $customer_orderinfo);
        // ->orderBy('item_id','desc');
        // dd($items);
          // dd (Datatables::of($items)->make());
      return  Datatables::of($customer_orderinfo)->make();
    }

    public function create()
    { 
       return View::make('item.create');
    }

    public function store(Request $request)
    {   
      $rules =[
        'description' => 'required|alpha|min:2|max:20',
        'cost_price' => 'numeric|min:1|max:9999999999',
        'sell_price' => 'numeric|min:1|max:9999999999',
        'img_path' => 'required|image|mimes:jpg,png,gif,jpeg,jfif,svg|max:2048',
      ];

      $messages = [
        'required' => '*Field Empty',
        'min' => '*Too Short!',
        'numeric' => '*Numbers Only',
        'description.required' => '*Item Name Required',
      ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{

        $input = $request->all();
        if($request->hasFile('img_path')){
            $img_path = $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->storeAs('public/images', $img_path);
            $input['img_path'] = $img_path;
        }
           dd($input);
         Item::create($input);
        return Redirect::to('item')->with('success','New Item added!');
         
         }
    }

    public function show($id)
    {
        $item = Item::find($id);      
        return View::make('item.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return View::make('item.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
     $rules =[
        'description' => 'required|alpha|min:2|max:20',
        'cost_price' => 'numeric|min:1|max:9999999999',
        'sell_price' => 'numeric|min:1|max:9999999999',
        'img_path' => 'required|image|mimes:jpg,png,gif,jpeg,jfif,svg|max:2048',
      ];

      $messages = [
        'required' => '*Field Empty',
        'min' => '*Too Short!',
        'numeric' => '*Numbers Only',
        'description.required' => '*Item Name Required',
      ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{

        $input = $request->all();
        if($request->hasFile('img_path')){
            $img_path = $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->storeAs('public/images', $img_path);
            $input['img_path'] = $img_path;
        }
        $item->update($input);
        return Redirect::to('item')->with('success','Item updated!');
    }
}

   
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect()->route('item.index')->with('success','Item deleted!');
    }

    public function import(Request $request) {
        $request->validate([
                'item_upload' => ['required', new ExcelRule($request->file('item_upload'))],
            ]);

        Excel::import(new ItemImport, request()->file('item_upload')->store('temp'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }

    public function exportExcel(Request $request) {
        // return Excel::download(new ItemExport, 'item.xlsx');
        return Excel::download(new ItemTableExport, 'item-table.xlsx');

    }

     public function exportPDF(Request $request) {
        return Excel::download(new PDFExport, 'item-table.pdf', \Maatwebsite\Excel\Excel::DOMPDF);

    }
}
