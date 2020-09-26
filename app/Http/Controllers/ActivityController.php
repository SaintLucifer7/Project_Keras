<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Activity::all()->toArray();
        return view('activity.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request, $type)
    {
        $activity = new Activity([
            'product_id' => $request->get('id'),
            'quantity' => $request->get('stock'),
            'type' => $type,
            'created_at' => new \DateTime()
        ]);
        $activity->save();
    }

    public static function storeDelete($product_id, $quantity, $type)
    {
        $activity = new Activity([
            'product_id' => $product_id,
            'quantity' => $quantity,
            'type' => $type,
            'created_at' => new \DateTime()
        ]);
        $activity->save();
    }
    
    public static function storeCut($product_id, $quantity, $type)
    {
        $activity = new Activity([
            'product_id' => $product_id,
            'quantity' => $quantity,
            'type' => $type,
            'created_at' => new \DateTime()
        ]);
        $activity->save();
    }
    public static function returnCut($product_id, $quantity, $type)
    {
        $activity = new Activity([
            'product_id' => $product_id,
            'quantity' => $quantity,
            'type' => $type,
            'created_at' => new \DateTime()
        ]);
        $activity->save();
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
        //
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
     //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);
        $activity->delete();
        return redirect()->route('activity.index')->with('success', 'Data Deleted');
    }
}
