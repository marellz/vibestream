<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleCors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response  = $next($request);

        $allowedOrigins = config('cors.allowed_origins');

        $requestOrigin = $request->header('Origin');

        if (in_array($requestOrigin, $allowedOrigins) || $requestOrigin === env('APP_URL')) {
            $response->headers->set('Access-Control-Allow-Origin', env('FRONTEND_URL','http://localhost:3000'));
            $response->headers->set('Access-Control-Allow-Methods', config('cors.allowed_headers'));
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            return $response;
        }
 
        return response()->json(['error' => 'Not allowed by CORS policy'], 403);

    }
}
