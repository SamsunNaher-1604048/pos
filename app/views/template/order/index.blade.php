@extends('layouts.master');
@section('content')

    <div class="container">
        <form action="{{route('order.filter')}}" method="post">
            @csrf
            <div class="row d-flex flex-row-reverse">
                <div class="col-auto mt-4">
                    <button type="submit" class="btn btn-success">filter</button>
                </div>
                <div class="col-auto">
                    <label for="start">Start Date:</label>
                    <input type="date" class="form-control" placeholder="Start Date" name="start" required>
                </div>
                <div class="col-auto">
                    <label for="end">End Date:</label>
                    <input type="date" class="form-control" placeholder="End Date" name="end" required>
                </div>
            </div>
        </form>
    </div>

    <div class="product_table m-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Total Order</th>
                <th scope="col">SubTotal</th>
                <th scope="col">Total Discount</th>
                <th scope="col">Total Tax</th>
                <th scope="col">GrandTotal</th>
            </tr>
            </thead>
            <tbody>

            @forelse($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->sub_total}}</td>
                    <td>{{$order->total_discount}}</td>
                    <td>{{$order->total_tax}}</td>
                    <td>{{$order->grand_total}}</td>
                </tr>
            @empty
                <tr>
                    <td class='text-muted text-center' colspan='100%'>No Order</td>
                </tr>
            @endforelse

            </tbody>
        </table>
        @if($orders->hasPages())
            <div class='card-footer'>
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
