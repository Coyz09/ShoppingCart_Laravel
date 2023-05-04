@extends('layouts.master')
@section('title')
  Customer
@endsection
@section('content')
<h1>Customer Information:</h1>
<h1>{{$customer->lname}}</h1>
   <div class="container">
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Customer ID</th>
        <th>Last name</th>
        <th>First name</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>
        <tr>
        <td>{{$customer->customer_id}}</td>
        <td>{{$customer->lname}}</td>
        
        <td>{{$customer->fname}}</td>
        <td>{{$customer->addressline}}</td>
        
      </tr>
     
    </tbody>
  </table>
  </div>
           <a href="{{route('product.index')}}" class="btn btn-primary a-btn-slide-text" role="button">
                <span><strong>Back</strong></span> 
          </a>  
  </div>
@endsection