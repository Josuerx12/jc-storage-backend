<?php

namespace App\Http\Middleware;

use App\Models\Credencial;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientCredentialsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accessKey = $request->header('access_key');
        $secretKey = $request->header('secret_key');

        $credential = Credencial::where('access_key', $accessKey)->first();

        if(! $credential){
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        if($credential->secret_key !== $secretKey){
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        return $next($request);
    }
}
