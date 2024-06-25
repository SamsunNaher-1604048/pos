@forelse($carts as $data)
    <tr class="table_row">
        <td>
            <img src="{{ asset('assets/images/product/'.$data->product->image) }}" alt="" height="30px" width="30px">
            <span class="product-name">{{ $data->product->name }}</span>
        </td>
        <td class="product-qty">
            <label>
                <input type="number" class="form-control productQuantity" data-cart_id = {{$data->id}} value={{ $data->quantity }}>
            </label>
        </td>
        <td>{{$data->product->selling_price - $data->product->discount}}TK</td>
        <td class="text-center">
            <button class="btn btn-danger btn-sm deleteData" data-cart_id = {{$data->id}}><i class="las la-trash-alt"></i></button>
        </td>
    <tr>
@empty
    <tr>
        <td>
            <span>@lang('Data Not Found')</span>
        </td>
    </tr>
@endforelse
