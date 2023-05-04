@extends('layouts.master')

@section('content')
<h1>ITEMS</h1>

@include('layouts.flash-messages')
 {{-- <div class="clearfix">
          @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
         @endif             
</div> --}}

<div class ="row">
   <div class="col-sm-10">
        <a href="{{route('item.create')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><strong>Add new item:</strong></span>            
        </a>
      </div>
   <div class="col-xs-6 col-sm-4 col-lg-2"> 
       <form method="post" enctype="multipart/form-data" action="{{ url('/import') }}">
          {{ csrf_field() }}
          <input type="file" id="uploadName" name="item_upload" required>
          <button type="submit" class="btn btn-info btn-primary " >Import Excel File</button>
       </form>        
       {{--  <button href= " {{ route('item.create') }} "> Add new item:</button> --}}
       </div>    
</div>

<div class="container">
  <div class="table-responsive">
  <table id= "item-table" class="table table-striped table-hover">
    <tr> </tr>
      <thead>
        <tr>
          {{-- <th>Item ID</th>
          <th>Item Description</th>
          <th>Item Cost Price</th>
          <th>Item Sell Price</th>
          <th> Any</th> --}}
          <th>OrderInfo ID</th>
          <th>Customer Fname</th>
          <th>Order Date Place</th>
       
          {{-- <th>Item Image</th> --}}
  		   {{--  <th>Edit</th>
          <th>Delete</th> --}}
          </tr>
      </thead>

    {{-- <tbody> --}}
        {{-- @foreach($items as $item) --}}
       {{--  <tr>
            <td>{{$item->item_id}}</td>
            <td><a href="{{route('item.show',$item->item_id)}}">{{$item->description}}</a></td>
            <td>{{$item->cost_price}}</td>
            <td>{{$item->sell_price}}</td> --}}
            {{-- <td>
              <img src="{{ url('storage/images/'.$item->img_path) }}" width="100px" height="100px" alt="..." class="img-responsive"></td> --}}

   		{{-- <td align="center"><a href="{{route('item.edit',$item->item_id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px" ></a></i></td>

             <td align="center">
              <form action="{{route('item.destroy',$item->item_id) }}" method = "POST">
              @csrf
              @method('DELETE')
              <button><i class="fa fa-trash-o" style="font-size:24px; color:red"></i></button>
              </form>
            </td> --}}
        
      {{-- </tr> --}}
     {{--  @endforeach --}}
      {{-- </tbody> --}}
      
    </table>
          <{{-- a href="{{route('item.exportExcel')}}" class="btn btn-primary a-btn-slide-text" role="button">
                <span><strong>Export to Excel</strong></span> </a>  
          <a href="{{route('item.exportPDF')}}" class="btn btn-primary a-btn-slide-text" role="button">
                <span><strong>Export to PDF</strong></span> </a>   --}}
    
  
      </div>  
  {{-- <ul class="pagination">
        {{ $items->links()}}
  </ul> --}}
@endsection

@section('scripts')
  <script >
    $(document).ready(function() 
    {
      $('#item-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('item.getItem') !!}',
            columns: [
              { data: 'orderinfo_id', name: 'orderinfo_id' },
              { data: 'fname', name: 'fname' },
              { data: 'date_placed', name: 'date_placed' },
 
             ]
        });
  });

  </script>
  @endsection