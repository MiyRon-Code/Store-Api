<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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

    public function byId(Request $request, $user_id)
    {
        $user = User::find($user_id);
        return response()->json($user);
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'=>['required','min:8']
        ];
        $validator = Validator::make($request->all(), $rules); 
        if($validator->fails()){
            return response()->json($validator->errors(),401);
        }
        else{
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            User::create($input);
            return response()->json(['status'=>"user was created"],200);
        }
    }

    public function token(Request $request)
    {
        //правила вадидации
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password'=>['required','min:8']
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
    public function destroy($user_id)
    {
         $user = User::destroy($user_id);
         return response()->json($user);
    }
}
