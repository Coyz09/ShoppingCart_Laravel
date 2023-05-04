{{-- @extends('layouts.master')

@section('content')
<h1>from dashboard</h1>
@endsection --}}

@extends('layouts.master')
@section('content')
<div class="container">
    {{-- {{dd($customerChart)}} --}}
  <div class="row">
    <div  class="col-sm-6 col-md-6">
        <h2>Customer Title Demographics</h2>
    @if(empty($customerChart))
        <div id="app2"></div>
    @else
          <div id="app2">{!! $customerChart->container() !!}</div>
        {!! $customerChart->script() !!}
     @endif   
    </div>

    <div class="row">
    <div  class="col-sm-6 col-md-6">
        <h2>Customer Town Demographics</h2>
    @if(empty($townChart))
        <div id="app2"></div>
    @else
          <div id="app2">{!! $townChart->container() !!}</div>
        {!! $townChart->script() !!}
     @endif   
    </div>

    <div class="row">
    <div  class="col-sm-6 col-md-6">
        <h2>Customer Sales Demographics</h2>
    @if(empty($salesChart))
        <div id="app2"></div>
    @else
          <div id="app2">{!! $salesChart->container() !!}</div>
        {!! $salesChart->script() !!}
     @endif   
    </div>

    <div class="row">
    <div  class="col-sm-6 col-md-6">
        <h2>Item Demographics</h2>
    @if(empty($itemChart))
        <div id="app2"></div>
    @else
          <div id="app2">{!! $itemChart->container() !!}</div>
        {!! $itemChart->script() !!}
     @endif   
    </div>
  </div>
@endsection