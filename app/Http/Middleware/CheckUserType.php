<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserType
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if (auth('api')->user()->user_type_id==2) {
            return response()->json(['data' => 'sellers are not allowed to place an order']);
        }

        return $next($request);
    }

}
