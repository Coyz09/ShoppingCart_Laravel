<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Charts\CustomerChart;
use App\Charts\TownChart;
use App\Charts\SalesChart;
use App\Charts\ItemChart;
// use App\User;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct(){
        $this->bgcolor = collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]);
    }
  // public function index(){
  // 	return view('dashboard.index');
  //  }

    public function index(){
     $customer = DB::table('customer')->groupBy('title')->pluck(DB::raw('count(title) as total'),'title')->all();
     $customerChart = new CustomerChart;
     // dd(array_keys($customer));
      $dataset = $customerChart->labels(array_keys($customer));
        // dd($dataset);
        $dataset= $customerChart->dataset('Customer Demographics', 'pie', array_values($customer));
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        $customerChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>false,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                          ]],
            ],
        ]);
        // dd($customerChart);
    $town = DB::table('customer')->whereNotNull('town')->groupBy('town')->pluck(DB::raw('count(town) as total'),'town')->all();
        // $town = DB::table('customer')->whereNotNull('town')->get('town');
     // dd($town);
     $townChart = new TownChart;
     // dd(array_values($customer));
      $dataset = $townChart->labels(array_keys($town));
        // dd($dataset);
        $dataset= $townChart->dataset('town Demographics', 'line', array_values($town));
        // dd($customerChart);
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        // dd($customerChart);
        $townChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> true],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                          ]],
            ],
        ]);

        $sales = DB::table('orderinfo AS o')
         ->join('orderline AS ol','o.orderinfo_id','=','ol.orderinfo_id')
         ->join('item AS i','ol.item_id','=','i.item_id')
         ->groupBy('o.date_placed')
         ->pluck(DB::raw('sum(ol.quantity * i.sell_price) AS total'),'o.date_placed')
         ->all();
        // dd($sales);
        $salesChart = new SalesChart;
     // dd(array_values($customer));
        $dataset = $salesChart->labels(array_keys($sales));
        // dd($dataset);
        $dataset= $salesChart->dataset('sales Demographics', 'horizontalBar', array_values($sales));
        // dd($customerChart);
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        // dd($customerChart);
        $salesChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                            // 'min'=> 0,
                            // 'stepSize'=> 1000,
                            'ticks' => [
                 'beginAtZero' => true,
                 // 'steps' => 1000,
                             //'stepValue' => 100,
                            // 'max' => 20000
                            ]
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'gridLines' => ['display' => false],
                            'display' => true,
                            'ticks' => [
                             'beginAtZero' => true,
                             'min'=> 0,
                             'stepSize'=> 10,
                        ]
                    ]],
                 ],
        ]);


        $items = DB::table('orderline AS ol')
            ->join('item AS i','ol.item_id','=','i.item_id')
            ->groupBy('i.description')
            ->pluck(DB::raw('sum(ol.quantity) AS total'),'description')
            ->all();
        $itemChart = new ItemChart;
        $dataset = $itemChart->labels(array_keys($items));
        $dataset= $itemChart->dataset('Item sold', 'line', array_values($items));
        $dataset= $dataset->backgroundColor($this->bgcolor);
        $dataset = $dataset->fill(false);
        $salesChart->options([
                    'responsive' => true,
                    'legend' => ['display' => true],
                    'tooltips' => ['enabled'=>true],
                    // 'maintainAspectRatio' =>true,
                    // 'title' => 'test',
                    'aspectRatio' => 1,
                    'scales' => [
                        'yAxes'=> [[
                                    'display'=>true,
                                    'ticks'=> ['beginAtZero'=> true],
                                    'gridLines'=> ['display'=> false],
                                    // 'min'=> 0,
                                    // 'stepSize'=> 1000,
                                    'ticks' => [
                         'beginAtZero' => true,
                         // 'steps' => 1000,
                                     //'stepValue' => 100,
                                    // 'max' => 20000
                                    ]
                                  ]],
                        'xAxes'=> [[
                                    'categoryPercentage'=> 0.8,
                                    //'barThickness' => 100,
                                    'barPercentage' => 1,
                                    'gridLines' => ['display' => false],
                                    'display' => true,
                                    'ticks' => [
                                     'beginAtZero' => true,
                                     'min'=> 0,
                                     'stepSize'=> 10,
                                ]
                            ]],
                         ],
                ]);

     return view('dashboard.index',compact('customerChart','townChart','salesChart','itemChart'));
    }
}
