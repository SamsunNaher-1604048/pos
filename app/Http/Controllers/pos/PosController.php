<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class PosController extends Controller
{
    protected $data = [];

    public function show(){
        $data['products'] = Product::orderBy('id', 'desc')->paginate(10);
        return view('template.pos.pos_template.index',$data);
    }

    public function addProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        if($request->id) {
            $product = Product::where('id',$request->id)->first();

            if ($product->product_unit_value == 0) {
                return response()->json(['error' => "Product stock out"]);
            }
        }

        $admin = session()->get('session_id');
        if ($admin == null) {
            session()->put('session_id', uniqid());
            $admin = session()->get('session_id');
        }

        $cart = Cart::where('admin_session',$admin)->where('product_id',$request->id)->first();

        if($cart){
            $cart->quantity = $cart->quantity+1;
            $cart->save();
        }else{
            $cart = new Cart();
            $cart->admin_session = $admin;
            $cart->product_id = $request->id;
            $cart->quantity = 1;
            $cart->save();

        }
        return response()->json(['success' => 'Added to Cart']);
    }

    public function getCartData(){
        $subtotal = 0;
        $discount = 0;
        $tax = 0;

        $admin = session()->get('session_id');
        $carts = Cart::with('product')->where('admin_session',$admin)->get();


        foreach ($carts as $data){
              $subtotal= $subtotal + ($data->product->selling_price - $data->product->discount)*$data->quantity;
              $discount = $discount +($data->product->discount*$data->quantity);
              $tax = $tax + (($data->product->selling_price - $data->product->discount)*($data->product->tax/100))*$data->quantity;
        }
        $discount =  floor($discount);
        $tax = ceil($tax);
        $total = $subtotal+$tax-$discount;

        return response()->json([
            'table' => view('template.pos.pos_includes.table', compact('carts'))->render(),
            'subtotal'=>$subtotal,'discount'=>$discount,'tax'=>$tax,'total'=>$total
        ]);
    }

    public function deleteData(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }
        $admin = session()->get('session_id');

        $cart = Cart::where('admin_session',$admin)->where('id',$request->id)->first();
        $cart->delete();
        return response()->json(['success' => 'Cart Item Delete successfully']);

    }

    public function changeQuantity(Request $request){

        $admin = session()->get('session_id');
        $cart = Cart::with('product')->where('id',$request->cart_id)
                     ->where('admin_session',$admin)
                     ->first();

        if ($cart->product->product_unit_value < $request->quantity) {
            return response()->json(['error' => "Product stock out"]);
        }
        $cart->quantity = $request->quantity;
        $cart->save();
        return response()->json(['success' => 'Cart Updated Successfully']);
    }

    public function emptyCart(){
        $admin = session()->get('session_id');
        $carts = Cart::where('admin_session',$admin)->get();

        if($carts){
            foreach ($carts as $cart){
                $cart->delete();
            }
            return response()->json(['success'=>'Cart successfully empty']);
        }
        return response()->json(['success'=>'Cart Already Empty']);
    }

    public function searchProduct(Request $request){

        $request->validate(["search" => "required"]);

        $item = $request->search;
        $products = Product::where('name','LIKE',"%$item%")->orWhere('sku', 'LIKE', "%$item%")->latest()->get();
        return view('template.pos.pos_includes.search',compact('products'));
    }
}
