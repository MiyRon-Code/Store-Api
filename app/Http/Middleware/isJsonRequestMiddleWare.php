<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isJsonRequestMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         //если заголовок запроса 'Content-Type' равен 'application/json' 
        if($request->header('Content-Type') == 'application/json') {
            //если json валидный
            if($request->json()->all()){
                return $next($request);
            }
            else{
                return response()->json('invalid JSON',400);    
            }
            
        }        
        else{
            return response()->json('buddy I\'m waiting JSON data',400);
        }
        
    }
}
