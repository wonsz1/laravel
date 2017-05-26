@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Edit Product
    </div>
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New Product Form -->
        <form action="{{ url('/product' . '/' . $product->id)}} " method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
                <label for="product" class="col-sm-3 control-label">Product</label>
                <div class="col-sm-9">
                    <input type="text" name="name" id="product-name" class="form-control" value="{{ $product->name }}">
                </div>
            </div>

            <div class="form-group">
                <label for="price" class="col-sm-3 control-label">Price</label>
                <div class="col-sm-9">
                    <input type="text" name="price" id="product-price" class="form-control" value="{{ $product->price }}">
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-9">
                    <input type="textarea" name="description" id="product-description" class="form-control" value="{{ $product->description }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>


@endsection