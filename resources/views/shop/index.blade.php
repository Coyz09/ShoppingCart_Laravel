{{-- @extends('layouts.master')

@section('title')
 laravel shopping cart
@endsection --}}
{{-- @section('styles')
<link href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    @foreach ($products->chunk(3) as $productChunk)
        <div class="row">
            @foreach ($productChunk as $product)
                <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <img src="{{ $product->imagePath }}" alt="..." class="img-responsive">
                    <div class="caption">
                            <h3>{{ $product->title }}</h3>
                            <p class="description">{{ $product->description }}</p>
                            <div class="clearfix">
                                <div class="pull-left price">${{ $product->price }}</div>
                                <a href="#" class="btn btn-default pull-right" role="button"><i class="fas fa-info"></i> More Info</a> 
                                <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn btn-primary pull-right" role="button">Add to Cart</a>

                                 
                            </div>
                        </div>
                  </div>
                </div>
              @endforeach
           </div>
    @endforeach
@endsection    --}}

@extends('layouts.master')
@section('title')
 laravel shopping cart
@endsection
@section('content')
   @foreach ($products->chunk(8) as $productChunk)
        <div class="row">
            @foreach ($productChunk as $product)
                <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    {{-- <img src="{{ url('/storage/images/'.$product->img_path) }}" alt="..." class="img-responsive"> --}}
                    <img src="{{ url('storage/images/'.$product->item->img_path) }}" {{-- width="3 00px" height="300px" --}} alt="..." class="img-responsive">
                  
                    <div class="caption">
                           <h3>{{ $product->item->description }}<span>${{ $product->item->sell_price }}</span></h3>
                      <p>{{ $product->item->description }}</p>
                      <div class="clearfix">
                           <a href="{{ route('product.addToCart', ['id'=>$product->item_id]) }}" class="btn btn-primary" role="button"><i class="fas fa-cart-plus"></i> Add to Cart</a> <a href="#" class="btn btn-default pull-right" role="button">
                            <i class="fas fa-info"></i> More Info</a>
                      </div>
                    </div>
                  </div>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
    @endforeach
@endsection
