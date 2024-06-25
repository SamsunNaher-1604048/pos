<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_details;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;

class OrderController extends Controller
{
    protected $data = [];
    public function index(){
        $data['orders']=Order::orderBy('id','desc')->paginate(10);
        return view('template.order.index',$data);
    }

    public function create(){
        $admin = session()->get('session_id');
        $carts = Cart::with('product')->where('admin_session',$admin)->get();
        $tax =0 ;
        $subtotal =0;
        $total= 0;
        $discount =0;
        if($carts){

            foreach ($carts as $data){
                $subtotal= $subtotal + ($data->product->selling_price - $data->product->discount)*$data->quantity;
                $discount = $discount +($data->product->discount*$data->quantity);
                $tax = $tax + (($data->product->selling_price - $data->product->discount)*($data->product->tax/100))*$data->quantity;
            }
//            return response()->json($carts);

            $discount =  floor($discount);
            $tax = ceil($tax);
            $total = $subtotal+$tax-$discount;
            //return response()->json([$subtotal,$discount,$tax,$total,count($carts)]);

            $order = new Order();
            $order->quantity = count($carts);
            $order->sub_total = $subtotal;
            $order->total_discount = $discount;
            $order->total_tax = $tax;
            $order->grand_total	= $total;
            $order->save();

            foreach ($carts as $cart){
                $orderDetails = new Order_details();
                $orderDetails->order_id = $order->id;
                $orderDetails->product_id =$cart->product->id;
                $orderDetails->quantity	= $cart->quantity;
                $orderDetails->price = ($data->product->selling_price - $data->product->discount)*$data->quantity;
                $orderDetails->discount = $data->product->discount*$data->quantity;
                $orderDetails->tax = (($data->product->selling_price - $data->product->discount)*($data->product->tax/100))*$data->quantity;
                $orderDetails->save();
            }

            foreach ($carts as $cart){
                $product = Product::where( 'id',$cart->product_id,)->first();
                $product->product_unit_value = $product->product_unit_value-$cart->quantity;
                $product->save();
            }

            foreach ($carts as $cart){
                $cart->delete();
            }

            return response()->json(['success'=>'order place Successfully']);


        }
        return response()->json(['error'=>'Cart is Empty']);
    }

    public function filter(Request $request){
        $data['orders'] = Order::whereBetween('created_at', [$request->start, $request->end])->paginate(10);
        return view('template.order.index',$data);
    }
}
