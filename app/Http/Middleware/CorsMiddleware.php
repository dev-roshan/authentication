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
    
    if($request->isMethod('OPTIONS')){
        $response = response('', 200);
    }
    else{
        $response = $next($request);
    }

    if($request->server('HTTP_ORIGIN')){
        $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH');
        $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        if (in_array($request->server('HTTP_ORIGIN'), $allowedOrigins)) {
            $response->header('Access-Control-Allow-Origin', '*');
        }
    }


    return $response;
}

}