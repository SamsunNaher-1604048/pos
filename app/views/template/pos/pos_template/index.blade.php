@extends('template.pos.pos_layouts.master')
@section('content')
    <div class="container-fluid pt-3">
        <div class="row gx-1">
            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="m-3 border">
                    <div class="p-3 border bg-light">
                        <span>Product Section</span>
                    </div>
                    <div class="px-3 pt-3">
                        <input class="form-control me-2 productSearch" name="search" type="text" placeholder="Enter Product Name / SKU" aria-label="Search">
                        <div class="request__product">

                        </div>
                    </div>
                    <div class="p-3">
                        <div class="row row-cols-1 row-cols-md-3 g-4 productShow">
                            @forelse($products as $product)
                                <div class="col-sm-6 col-md-3 col-lg-2 addToCart" data-product_id="{{$product->id}}">
                                    <div class="card">
                                        <div class="text-center pt-3">
                                            <img src="{{asset('assets/images/product/'.$product->image)}}" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <span class="card-title">{{ Str::limit($product->name, 10) }}</span><br>
                                                <span class="card-title">@if($product->discount < 0){{$product->selling_price}} @else {{$product->selling_price - $product->discount}}@endif</span> @if($product->discount > 0)<del class="del-test">{{$product->selling_price}}</del>@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class='text-muted text-center' colspan='100%'>No Product Add</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                @if($products->hasPages())
                    <div class='card-footer'>
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="m-3 border">
                    <div class="p-3 border bg-light">
                        <span>Billing Section</span>
                    </div>

                    <div class="p-3">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">qty</th>
                                    <th scope="col">Price</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody class="table_body">
                                </tbody>
                            </table>
                        </div>

                        <div class="cal-area">
                            <div class="d-flex justify-content-between">
                                <span>Subtotal : </span>
                                <span><span class="subTotal">0</span><span>TK</span></span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span>Product Discount : </span>
                                <span><span class="discount">0 </span><span>TK</span></span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span>Tax : </span>
                                <span><span class="tax">0</span><span>TK</span></span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span>Total : </span>
                                <span><span class="fw-bold total">0</span><span>TK</span></span>
                            </div>
                        </div>

                        <div class="submit gap-2 mt-3 d-flex justify-content-between">
                            <button class="btn btn-danger emptyCart" type="button">Empty Cart</button>
                            <button class="btn btn-success text-end placeOrder" type="button">Place Order</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection






