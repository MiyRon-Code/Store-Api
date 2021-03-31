<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function byId($category_id)
    {
        $category = Category::find($category_id);
        if($category){
            return response()->json($category);
        }   
        else{
            return response()->json([],404);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
            'code' => 'required',
            'name' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else{
          $category = Category::create($request->all());
          return response()->json($category);
        }
    }
    
    public function products($category_id)
    {
        if(Category::find($category_id)){
            $products =  Category::find($category_id)->products;
            return response()->json($products);
        }
        else{
            return response()->json([],404);
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
    public function update(Request $request, $categoty_id)
    {
        $rules = [
            'name' => 'required|unique:categories'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else{
            $input = $request->all();
            $category = Category::whereId($categoty_id)->update([
                'name' => $input['name'],
                'code' => hash('crc32b', $input['name'].now()),
            ]);
            if($category){
                return response()->json($category); 
            }
            else{
                return response([],404);
            }
           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id)
    {
        $category = Category::withTrashed()->where('id',$category_id);
        if($category){
            $category->forceDelete();
            return response()->json($category);
        }
        else{
            return response()->json($category,404);
        }
    }
    public function delete($category_id)
    {
        $category = Category::find($category_id);
        if($category){
            $category->delete();
            return response()->json($category);
        }
        else{
            return response()->json($category,404);
        }
    }
}
