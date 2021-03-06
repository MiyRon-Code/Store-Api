<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellerCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::all();
        return response()->json($sellers);
    }

    public function byId($seller_id){
        $seller = Seller::find($seller_id);
        return response()->json($seller);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required',
            'mail' => 'required|email',
            'address' => 'required',
            'phone_number' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        else{
            $seller = Seller::create($request->all());
            return response()->json($seller);
        }
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
    public function update(Request $request, $seller_id)
    {
        $seller = Seller::find($seller_id);
        if($seller){
            $rules = [
                'name' => 'required',
                'mail' => 'required|email',
                'address' => 'required',
                'phone_number' => 'required'
            ];
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return response()->json($validator->errors(),400);
            }
            else{
                Seller::whereId($seller_id)->update($request->all());
                $seller = Seller::find($seller_id);
                return response()->json($seller);
            }
        }
        else{
            return response([],404);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($seller_id)
    {
        $seller = Seller::withTrashed()->where('id',$seller_id);
         if($seller){
            $seller->forceDelete();
            return response()->json($seller);
         }
         else{
            return response()->json($seller,404); 
         }
    }
    public function delete($seller_id)
    {
        $seller = Seller::find($seller_id);
        if($seller){
            $seller->delete();
            return response()->json($seller);
        }
        else{
            return response()->json($seller,404); 
        }
    }
}
