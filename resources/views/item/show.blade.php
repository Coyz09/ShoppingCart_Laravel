@extends('layouts.master')
@section('title')
  Item
@endsection
@section('content')
<h1>Info Information:</h1>
<h1>{{$item->description}}</h1>
   <div class="container">
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Item ID</th>
        <th>Item Cost Price</th>
        <th>Item Sell Price</th>
        <th>Item Image</th>
      </tr>
    </thead>
    <tbody>
        <tr>
        <td>{{$item->item_id}}</td>
        <td>{{$item->cost_price}}</td>
        <td>{{$item->sell_price}}</td>
        <td>
              <img src="{{ url('storage/images/'.$item->img_path) }}" width="100px" height="100px" alt="..." class="img-responsive"></td>
      </tr>
     
    </tbody>
  </table>
  </div>
           <a href="{{route('item.index')}}" class="btn btn-primary a-btn-slide-text" role="button">
                <span><strong>Back</strong></span> 
          </a>  
  </div>
@endsection