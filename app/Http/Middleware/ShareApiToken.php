<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ShareApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only add token for Inertia responses and authenticated users
        if ($response instanceof \Inertia\Response && Auth::check()) {
            $user = Auth::user();
            
            // Get existing token or create new one if it doesn't exist
            $token = session('api_token');
            
            if (!$token) {
                // Delete old tokens and create new one
                $user->tokens()->delete();
                $token = $user->createToken('web-session')->plainTextToken;
                session(['api_token' => $token]);
            }
            
            // Share token with all Inertia responses
            $response->with('apiToken', $token);
        }

        return $response;
    }
}
