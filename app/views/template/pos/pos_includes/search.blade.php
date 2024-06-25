<div class="row row-cols-1 row-cols-md-3 g-4 pt-3">
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
