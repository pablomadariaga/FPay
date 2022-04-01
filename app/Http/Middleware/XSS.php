<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XSS
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
        $input = $request->all();
        array_walk_recursive($input, function ($value, $key) {
            if($key!='password' && $key!='password_confirmation' && $key!='pass'){
                $input[$key] = htmlspecialchars(strip_tags($value));
            }
        });
        $request->merge($input);
        return $next($request);
    }
}
