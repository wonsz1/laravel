@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Add Product
    </div>
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New Product Form -->
        <form action="{{ url('/product')}} " method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- Product Name -->
            <div class="form-group">
                <label for="product" class="col-sm-3 control-label">Product</label>
                <div class="col-sm-9">
                    <input type="text" name="name" id="product-name" class="form-control">
                </div>

                <label for="price" class="col-sm-3 control-label">Price</label>
                <div class="col-sm-9">
                    <input type="text" name="price" id="product-price" class="form-control">
                </div>

                <label for="description" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-9">
                    <input type="textarea" name="description" id="product-description" class="form-control">
                </div>
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
                                <div>{{ $product->description }}</div>
                            </td>

                            <td>
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
            </div>
        </div>
    @endif


    <!-- TODO: Current Products -->
@endsection