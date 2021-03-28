<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                'category_id' => $product->category_id,
                //добавляем название категории
                'category' => $product->category->name,
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
        //если заголовок запроса 'Content-Type' равен 'application/json' 
        if ($request->header('Content-Type') == 'application/json') {
            //если json валидный
            if($request->json()->all()){
                //правила вадидации
                $request->validate([
                    'name'=>'required',
                    'description'=>'required',
                    'price'=>'required'
                ]);
                //создаём запись
                Product::create($request->all());
                return response()->json($request->all());
            }
            else{
                return response()->json('invalid JSON',400);    
            }
        }        
        else{
            return response()->json('buddy I\'m waiting JSON data',400);
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
        //
    }
}
