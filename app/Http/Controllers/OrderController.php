<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

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
        //hash('crc32b', $request->all()['name']),
        $order = Order::create([
            'code' =>hash('crc32b', $product_id.$request->user()->id.now()),
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
    public function update(Request $request, $order_id)
    {
        $rules = [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'product_id' => 'required|numeric|exists:App\Models\Product,id',
            'confirmed' => 'required|boolean'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        else{
            $input = $request->all();
            Order::whereId($order_id)->update([
                'code' => hash('crc32b', $input['product_id'] .$input['user_id'] .now()),
                'user_id' => $input['user_id'],
                'product_id' => $input['product_id'],
                'confirmed' => $input['confirmed']
            ]);
            $order = Order::find($order_id);
            return response()->json($order);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order_id)
    {
        $order = Order::withTrashed()->where('id',$order_id);
        if($order){
            $order->forceDelete();
            return response()->json($order);
        }
        else{
            return response()->json($order,404);
        }
    }

    public function destroyMyOrders(Request $request)
    {
        $myOrders = Order::withTrashed()->where('user_id',$request->user()->id);
        $myOrders->forceDelete();
        return response()->json($myOrders);
    }

    public function destroyAll(){
        $orders = Order::withTrashed()->forceDelete();
        return response()->json($orders);
    }

    public function delete($order_id)
    {
        $order = Order::withTrashed()->where('id',$order_id);
        if($order){
            $order->delete();
            return response()->json($order);
        }
        else{
            return response()->json($order,404);
        }
    }

    public function deleteMyOrders(Request $request)
    {
        $myOrders = Order::withTrashed()->where('user_id',$request->user()->id);
        $myOrders->delete();
        return response()->json($myOrders);
    }

    public function deleteAll(){
        $orders = Order::withTrashed()->delete();
        return response()->json($orders);
    }
}
