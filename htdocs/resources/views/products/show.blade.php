@extends('layouts.app')

@section('content')


<div class="panel panel-default">
    <div class="panel-heading">
        <h4>{{ $product->name }}</h4>
    </div>
    <div class="panel-body">
        <div class="row">
                <div class="item col-sm-6 col-md-7">
                    <div class="thumbnail">
                        @foreach ($product->images as $image) 
                        <img class="group list-group-image" src="{{ url('uploads') . '/' . $image->path }}" name="{{ $image->name }}"/>
                        @endforeach

                        @if (count($product->images) == 0)
                        <img src="{{ url('img/default.jpg') }}" name="default"/>
                        @endif 
                    </div>
                </div>
                <div class="col-sm-6 col-md-5">
                    <div class="col-xs-12 col-md-12">
                        <span class="full-span">Price: ${{ $product->price }}</span>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <div class="input-group quantity-buttons">
                              <span class="input-group-btn">
                                  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                    <span class="glyphicon glyphicon-minus"></span>
                                  </button>
                              </span>
                              
                              <input type="text" name="quant[2]" class="form-control input-number text-center" value="1" min="1" max="100">
                              
                              <span class="input-group-btn">
                                  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                      <span class="glyphicon glyphicon-plus"></span>
                                  </button>
                              </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <a class="btn btn-success btn-block" href="{{ url('/product/' . $product->id) }}">Add to cart</a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <p class="">{!! nl2br($product->description) !!}</p>
                </div>
        </div>
    </div>
</div>
@endsection