<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupabaseAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Authentication token required'], 401);
        }

        try {
            $secret = env('SUPABASE_JWT_SECRET');
            
            if (!$secret) {
                return response()->json(['error' => 'JWT Secret not configured'], 500);
            }

            // Decode the Supabase JWT
            $decoded = JWT::decode($token, new Key($secret, 'HS256'));

            // Attach user info to the request
            $request->attributes->add(['supabase_user' => $decoded]);
            $request->setUserResolver(function () use ($decoded) {
                return $decoded;
            });

            return $next($request);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Invalid token',
                'message' => $e->getMessage()
            ], 401);
        }
    }
}
