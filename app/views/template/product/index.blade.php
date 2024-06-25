@extends('layouts.master');
@section('content')
    <div class="d-flex p-2">
        <a class="btn btn-success" href="{{route('product.create')}}">Add Product</a>
    </div>

    <div class="product_table m-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Selling Price</th>
                <th scope="col">Purchase Price</th>
                <th scope="col">Discount</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>

            @forelse($products as $product)
                <tr>
                    <td><img class="image" src="{{asset('assets/images/product/'.$product->image)}}" alt="Image"></td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->product_unit_value}}{{$product->product_unit}}</td>
                    <td>{{$product->selling_price}}</td>
                    <td>{{$product->purchase_price}}</td>
                    <td>{{$product->discount}}</td>
                    <td>
                        <a type="button" class="btn btn-success" href="{{route('product.edit',$product->id)}}">Edit</a>
                        <a type="button" class="btn btn-danger custom_btn" href ="{{route('product.delete',$product->id)}}">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class='text-muted text-center' colspan='100%'>No Product Add</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
@endsection
