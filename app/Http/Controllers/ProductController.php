<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $data = [];

    public function index(){
        $data['products'] = Product::orderBy('id', 'desc')->get();
        return view('template.product.index',$data);
    }

    public function create(){
        return view('template.product.create');
    }

    public function store(Request $request){
       $validation = Validator::make($request->all(),[
            'name'=>'required',
            'product_unit'=>'required',
            'product_unit_value'=>'required',
            'selling_price'=>'required',
            'purchase_price'=>'required',
            'tax'=>'required',
            'image'=>'required'
        ]);

       if($validation->fails()){
           return redirect()->back()->withErrors($validation);
       }

       if($request->hasFile('image')){
           $file = $request->file('image');
           $exten = $file->getClientOriginalExtension();
           $filename = time().".".$exten;
           $file->move('assets/images/product',$filename);
       }

       $product = new Product();
       $product->name = $request->name;
       $product->sku = 'PROD-'.str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
       $product->product_unit =$request->product_unit;
       $product->product_unit_value	= $request->product_unit_value;
       $product->selling_price = $request->selling_price;
       $product->purchase_price	= $request->purchase_price;
       $product->discount = $request->discount??0;
       $product->tax = $request->tax;
       $product->image = $filename;
       $product->save();

       $alart = ['success', 'Product Add Successfully'];
       return redirect()->back()->withAlart($alart);
    }

    public function edit($id){
        $data['product'] = Product::findOrFail($id);
        return view('template.product.edit',$data);
    }

    public function update(Request $request,$id){
       $product = Product::findOrFail($id);

        $validation = Validator::make($request->all(),[
            'name'=>'required',
            'product_unit'=>'required',
            'product_unit_value'=>'required',
            'selling_price'=>'required',
            'purchase_price'=>'required',
            'tax'=>'required',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }

        $product->name = $request->name;
        $product->product_unit =$request->product_unit;
        $product->product_unit_value = $request->product_unit_value;
        $product->selling_price = $request->selling_price;
        $product->purchase_price = $request->purchase_price;
        $product->discount = $request->discount;
        $product->tax = $request->tax;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $exten = $file->getClientOriginalExtension();
            $filename = time().".".$exten;
            $file->move('assets/images/product',$filename);
            unlink('assets/images/product/',$product->image);
            $product->image = $filename;
        }
        $product->save();

        $alart = ['success', 'Product Update Successfully'];
        return redirect()->back()->withAlart($alart);
    }

    public function delete($id){
        $product = Product::findOrfail($id);
        $product->delete();
        return redirect()->route('product.index');
    }

}
