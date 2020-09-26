<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use Redirect;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
    }

    public function cutStock($id)
    {
        $product = Product::find($id);
        return view('cut', compact('product','id'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'product_id' => 'required',
            'quantity' => 'required'
        ]);
        $price = $request->get('price');
        $quantity = $request->get('quantity');
        if($quantity > $request->get('stock'))
        {
            $product = Product::find($request->get('product_id'));
            return Redirect::back()->withErrors(['Chosen quantity cant be more than stock']);
        }
        else
        {
            $cart = DB::table('carts')->where('product_id' ,$request->get('product_id'))->limit(1);
            $awal = DB::table('carts')->where('product_id' ,$request->get('product_id'))->value('quantity');
            if ($awal!=null)
            {
                $price = DB::table('carts')->where('product_id' ,$request->get('product_id'))->value('price');
                $amountawal = DB::table('carts')->where('product_id' ,$request->get('product_id'))->value('amount');
                $cart->update([
                    'quantity'=>$awal+$request->get('quantity'),
                    'amount'=>$amountawal + ($price*$request->get('quantity'))
                ]);
            }
            else
            {
                $cart = new Cart([
                    'product_id' => $request->get('product_id'),
                    'name' => $request->get('name'),
                    'price' => $price,
                    'quantity' => $quantity,
                    'amount' => ($price * $quantity),
                ]);
                $cart->save();
            }
            ProductController::updateCutStock($request, $request->get('product_id'));
            ActivityController::storeCut($request->get('product_id'), $request->get('quantity'),'cut');

            $cart = Cart::all()->toArray();
            return view('cart', compact('cart'));
        }
    }
    
    public function destroy($id)
    {
        $cart = DB::table ('carts')->where ('id',$id)->limit(1);
        $quantity =  DB::table('carts')->where('id' ,$id)->value('quantity');
        $productid =  DB::table('carts')->where('id' ,$id)->value('product_id');
        ActivityController::storeCut($productid, $quantity,'return');
        $product = DB::table('products')->where ('id',$productid)->limit(1);
        $qtyawal =  DB::table('products')->where ('id',$productid)->value('stock');
        $product->update([
            'stock' => $qtyawal + $quantity
        ]);
        $cart->delete();
        $cart = Cart::all()->toArray();
        return view('cart', compact('cart'));

        
    }
}
