<?php namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
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
    $allowedOrigins = explode(',',env('FRONTEND_ENDPOINTS'));
    
    if($request->server('HTTP_ORIGIN')){
        if (in_array($request->server('HTTP_ORIGIN'), $allowedOrigins)) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', $request->server('HTTP_ORIGIN'))
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
                ->header('Access-Control-Allow-Headers', '*');
        }
    }


    return $next($request);
}

}