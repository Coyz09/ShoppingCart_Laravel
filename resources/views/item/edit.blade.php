@extends('layouts.master')
@section('content')
<div class="container">
  <h2>Update Item</h2>
  {!! Form::model($item,['method'=>'PATCH','route' => ['item.update',$item->item_id],'files' => true])!!}

  <div class="row">
    <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        {!!Form::label('Item Name:')!!}
        {!! Form::text('description',$item->description,array('class' => 'form-control')) !!}
          @if($errors->has('description'))
          <a>{{ $errors->first('description') }}</a>
         @endif 
      </div>
    </div>

    <div class="row">
    <div class="col-md-4"></div>
      <div class="form-group col-md-4">
       {!!Form::label('Cost Price:')!!}
       {!! Form::text('cost_price',$item->cost_price,array('class' => 'form-control')) !!}
        @if($errors->has('cost_price'))
          <a>{{ $errors->first('cost_price') }}</a>
         @endif 
      </div>
    </div>

    <div class="row">
    <div class="col-md-4"></div>
      <div class="form-group col-md-4">
       {!!Form::label('Selling Price:')!!}
       {!! Form::text('sell_price',$item->sell_price,array('class' => 'form-control')) !!}
        @if($errors->has('sell_price'))
          <a>{{ $errors->first('sell_price') }}</a>
         @endif 
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        {!!Form::label('Select image to upload:')!!}
        {!! Form::file('img_path', ['class' => 'form-control']); !!}
          @if($errors->has('img_path'))
          <a>{{ $errors->first('img_path') }}</a>
         @endif
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
        <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-primary">Update</button>
             <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
      </div>
    </div> 
    
  </div>     
</div>
{!! Form::close() !!}
@endsection