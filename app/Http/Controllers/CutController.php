<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Activity;
use App\Cart;

class PagesController extends Controller
{
    public function stockList()
    {
        
        $products = Product::all()->toArray();
        return view('product.index', compact('products'));
    }

    public function addStock()
    {
        return view('product.create');
    }
    public function dashboard()
    {
        return view('home');
    }
    public function history()
    {
        $activities = Activity::all()->toArray();
        return view('activity', compact('activities'));
    }  
    public function cartList()
    {
        $cart = Cart::all()->toArray();
        return view('cart', compact('cart'));
    }
    //buat naro ke databesnya cobacoba
    public function cutttt(Request $request,$id)
    {
        $product = new Cart([
            'id' => $request->get('id'),
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'stock' => $qty
        ]);
        $product->save();
        ActivityController::storeCut($request, 'add to cart');
            
        //Balik ke halaman depan 
        $products = Product::all()->toArray();
        return view('cut', compact('products'))->with('success', 'Data Added to Cart');
      
    }

}

