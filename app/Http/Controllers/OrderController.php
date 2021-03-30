<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::all();
        return response()->json($orders);
    }
    public function myOrders(Request $request){
        $myOrders = Order::all()->where('user_id',$request->user()->id);
        return response()->json($myOrders);
    }
    
    public function confirmed(Request $request){
        $confirmedOrders = Order::all()->where('confirmed',true);
        return response()->json($confirmedOrders);
    } 

    public function unconfirmed(Request $request){
        $confirmedOrders = Order::all()->where('confirmed',false);
        return response()->json($confirmedOrders);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $product_id)
    {
        $order = Order::create([
            'code' => 'asda',
            'product_id' => $product_id,
            'user_id' => $request->user()->id,
            'confirmed' => false,
        ]);
        return response()->json($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($order_id)
    {
        $order = Order::destroy($order_id);
        return response()->json($order);
    }
    public function destroyAll(){

    }
}
