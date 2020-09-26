<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Activity;
use App\Cart;
use Redirect;
// use App\Http\Controller

class ProductController extends Controller
{
    public function index()
    {
        // $products = DB::table('products');
        // return view('product.index',  ['products'=>$products]);
    
        $products = Product::all()->toArray();
        return view('product.index', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);
        $product = new Product([
            'id' => $request->get('id'),
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock'),
            'description' => $request->get('description'),
            'location' => $request->get('location')
            
        ]);
        $product->save();
        ActivityController::store($request, 'create');
        return redirect()->route('product.index')->with('success', 'Data Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'price'=> 'required',
            'stock' => 'required'
        ]);
        $product = Product::find($id);
        $qtyFromDb = $product->stock;
        $qtyNambah = $qtyFromDb + $request->stock;
        $product->update([
            'id' => $request->get('id'),
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'stock' => $qtyNambah,
            'description' => $request->get('description'),
            'location' => $request->get('location')
        ]);
        $product->save();
        ActivityController::store($request, 'update');
        return redirect()->route('product.index')->with('success', 'Data Has Been Updated !');
    }

    public static function updateCutStock(Request $request, $id)
    {
        $product = Product::find($id);
        $stock = $product->stock;
        $product->update([
            'id' => $request->get('product_id'),
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'stock' => $stock-$request->get('quantity')
        ]);
        $product->save();
        return redirect()->route('product.index')->with('success', 'Data Has Been Updated !');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isincart = DB::table('carts')->where('product_id', $id)->value("product_id");
        if($isincart != null)
        {
            $product=Product::find($id);
            return Redirect::back()->withErrors(['Remove product from cart first!']);
        }
        $product = Product::find($id);
        ActivityController::storeDelete($product->id,$product->stock,'delete');
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Data Deleted');
    }

    public function search(Request $request)
    {
        //kalo objek
        // $search = $request->get('search');
        // $products = DB::table('products')->where('name', 'like', '%'.$search.'%') ->paginate(5);
        // return view('product.index', ['products'=>$products]);

        //kalo array 
        $search = $request ->input('search');

        $products = Product::where('id','like',"%$search%")->get();

        return view('product.index')->with('products',$products);
    }
 
    public function flush(){
        DB::table('carts')->delete();
        return redirect('/cart-list');
    }
}
