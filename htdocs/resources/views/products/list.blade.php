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
                <div class="col-sm-3">
                    <div class="">{{ $product->name }}</div>
                    <div class="product-img">
                        @foreach ($product->images as $image) 
                        <img src="{{ url('uploads') . '/' . $image->path }}" name="{{ $image->name }}"/>
                        @endforeach

                        @if (count($product->images) == 0)
                        <img src="{{ url('img/default.jpg') }}" name="default"/>
                        @endif 
                    </div>
                    <div class="">{{ $product->price }} <button>KUP MNIE</button></div>
                </div>
            @endforeach
        </div>
</div>
</div>
@endif


<!-- TODO: Current Products -->
@endsection