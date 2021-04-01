<?php

namespace App\Http\Controllers;

use App\Jobs\MailProcess;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistration;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    public function indexAll()
    {
        $users = User::withTrashed()->get();
        return response()->json($users);
    }

    public function byId(Request $request, $user_id)
    {   
        
        $user = User::find($user_id);
        if($user){
            return response()->json($user);
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
        //правила вадидации
        $rules = [
            'name'=>'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password'=>'required|min:8'
        ];
        $validator = Validator::make($request->all(), $rules); 
        if($validator->fails()){
            return response()->json($validator->errors(),401);
        }
        else{
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            
            $user = User::create($input);
            MailProcess::dispatch($user);

            Mail::to($user->email)->send(new UserRegistration($user->name));
            return response()->json(['status'=>"user was created"],200);
        }
    }

    public function token(Request $request)
    {
        //правила вадидации
        $rules = [
            'email' => 'required|string|email|max:255',
            'password'=>'required|min:8'
        ];
        $validator = Validator::make($request->all(), $rules); 
        if($validator->fails()){
            return response()->json($validator->errors(),401);
        }
        else{
            $user = User::where('email', $request->email)->first();
            if (!$user ||  !Hash::check($request->password, $user->password)){
                return response()->json('invalid password', 401);
            }
            else{
                return response()->json(['token' => $user->createToken('auth token')->plainTextToken]);
            }
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
    public function update(Request $request, $user_id)
    {
        if(User::find($user_id)){
            $rules = [
                'name'=>'required',
                'email' => 'required|string|email|max:255|unique:users',
                'password'=>'required|min:8'
            ];
            $validator = Validator::make($request->all(), $rules); 
            if($validator->fails()){
                return response()->json($validator->errors());
            }
            else{
                User::where('id',$user_id)->update($request->all());
                return User::find($user_id);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
         $user = User::withTrashed()->where('id',$user_id);
         if($user){
            $user->forceDelete();
            return response()->json($user);
         }
         else{
            return response()->json($user,404); 
         }
    }
    public function delete($user_id){
        $user = User::find($user_id);
        if($user){
            $user->delete();
            return response()->json($user);
        }
        else{
            return response()->json($user,404); 
        }
    }
    public function tokenDelete (Request $request){
        $result = $request->user()->currentAccessToken()->delete();
        return response()->json($result);
    }
}
