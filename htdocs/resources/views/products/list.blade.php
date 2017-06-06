@extends('layouts.app')

@section('content')

@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@if (count($products) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Add Product
    </div>
    <div class="panel-body">
        <div class="row">
            @foreach ($products as $key => $product)
            @if ($key && $key % 4 == 0) 
            </div>
            <div class="row">
            @endif
                <div class="item  col-sm-4 col-md-3">
                    <div class="thumbnail">
                        @foreach ($product->images as $image) 
                        <img class="group list-group-image" src="{{ url('uploads') . '/' . $image->path }}" name="{{ $image->name }}"/>
                        @endforeach

                        @if (count($product->images) == 0)
                        <img src="{{ url('img/default.jpg') }}" name="default"/>
                        @endif 
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading">{{ $product->name }}</h4>
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <span class="full-span">${{ $product->price }}</span>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <a class="btn btn-success btn-block" href="{{ url('/product/' . $product->id) }}">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</div>
</div>
@endif


<!-- TODO: Current Products -->
@endsection