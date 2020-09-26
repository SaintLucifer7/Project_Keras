<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Activity;
use App\Cart;
use App\User;
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
    public function account()
    {
        $user = User::all()->toArray();
        return view('account',compact('user'));
    }

}
