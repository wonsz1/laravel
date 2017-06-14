@extends('layouts.app')

@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
        Add Product
    </div>
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New Product Form -->
        <form action="{{ url('/product')}} " method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="product" class="col-sm-3 control-label">Product</label>
                <div class="col-sm-9">
                    <input type="text" name="name" id="product-name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="price" class="col-sm-3 control-label">Price</label>
                <div class="col-sm-9">
                    <input type="text" name="price" id="product-price" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Image</label>
                <div class="col-sm-9">
                    <input type="file" name="image" id="image" />
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-9">
                    <textarea name="description" id="product-description" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>

    @if (count($products) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Products
            </div>

            <div class="panel-body">
                <table class="table table-striped product-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Product</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <!-- Product Name -->
                            <td class="table-text">
                                <div>{{ $product->name }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $product->price }}</div>
                            </td>
                            <td class="table-text">
                                @foreach ($product->images as $image) 
                                <div><img src="{{ url('uploads') . '/' . $image->path }}" name="{{ $image->name }}" /></div>
                                @endforeach
                            </td>

                            <td>
                                <a href="{{ url('/product/' . $product->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                <form action="{{ url('/product/' . $product->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" id="delete-product-{{ $product->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="row">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    @endif


    <!-- TODO: Current Products -->
@endsection