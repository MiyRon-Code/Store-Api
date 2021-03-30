<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function byId($id){
        return response()->json(Product::find($id));
    }
    public function index()
    {
        //получаем все продукты
        $products = Product::all();
        //массив который будет отправлен оветом
        $productsResponce = array();
        //добавляем в массив ответа данные
        foreach($products as $product ){
            $productResponce = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'category_id' => $product->category_id,
                //добавляем название категории
                'category' => $product->category->name,
                'seller_id' => $product->seller_id,
                'seller_name' => $product->seller->name,
                'price' => $product->price,
                'created_at' => json_encode($product->created_at),
                'updated_at' => json_encode($product->updated_at), 
            ];
            array_push($productsResponce,$productResponce);
        }
        //отвечаем
        return response()->json($productsResponce);
    }

    public function byCategoryId($category_id)
    {
        $products =  Product::all()->where('category_id',$category_id);
        
        $productsResponce = array();
        //добавляем в массив ответа данные
        foreach($products as $product ){
            $productResponce = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'category_id' => $product->category_id,
                //добавляем название категории
                'category' => $product->category->name,
                'seller_id' => $product->seller_id,
                'seller_name' => $product->seller->name,
                'price' => $product->price,
                'created_at' => json_encode($product->created_at),
                'updated_at' => json_encode($product->updated_at), 
            ];
            array_push($productsResponce,$productResponce);
        }
        //отвечаем
        return response()->json($productsResponce);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //правила вадидации
        $rules = [
            'name'=>'required',
            'category_id'=>'required|numeric',
            'description'=>'required',
            'price'=>'required|numeric'
        ];
        $validator= Validator::make($request->all(),$rules);
        //если не валидные данные то возвращаем ошибку
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        else{
            //создаём запись
            Product::create($request->all());
            return response()->json($request->all());
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
    public function update(Request $request, $product_id)
    {
        //правила вадидации
        $rules = [
            'name'=>'required',
            'category_id'=>'required|numeric',
            'description'=>'required',
            'price'=>'required|numeric'
        ];
        $validator= Validator::make($request->all(),$rules);
        //если не валидные данные то возвращаем ошибку
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        else{
            Product::whereId($product_id)->update($request->all());
            $product = Product::find($product_id);
            return response()->json($product);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
