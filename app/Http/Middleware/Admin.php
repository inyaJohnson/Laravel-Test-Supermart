<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // @TODO implement
        if(auth()->user->is_admin !== 1){
            return response()->json([
                'status' => 'error',
                'message'=>'You are unauthorized to access this resource'
            ]);
        }
        return $next($request);
    }
}
