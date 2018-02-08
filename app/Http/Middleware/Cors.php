<?php
/*The Cors.php 
is do as middleware for 
related between the laravel and Angular*/
namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     //Here we write the type of the request that is related between laravel and Angular
    public function handle($request, Closure $next)
    {
        return $next($request)
        ->header('Access-Control-Allow-Origin','*')
        ->header('Access-Control-Allow-Methods','POST,GET,PUT,PATCH,DELETE,OPTIONS')
        ->header('Access-Control-Allow-Headers','Content-Type,Authorization,X-Requested-With');
    }
}
