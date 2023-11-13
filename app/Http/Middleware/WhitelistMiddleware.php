<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Whitelist;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WhitelistMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');

        $whitelist = Whitelist::where('ip_address', $ipAddress)
            ->where('user_agent', $userAgent)
            ->first();

        if (!$whitelist) {
            return response()->json([
                'status'=> 'error',
                'message'=> 'Access Denied',
                ], Response::HTTP_BAD_REQUEST);
            // return $next($request);
        }

        return $next($request);
    }
}
