<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use \App\Models\UserKeys ;

class UserKeysMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userApiKey = $request->header('x-api-key');
        $userSecret = $request->header('x-api-secret');
        return $next($request);
        // if (empty($userApiKey) || empty($userSecret)) {
        //     return response()->json([
        //         'status'=> 'error',
        //         'message'=> 'Bad request Please fill in your key and secret keys',
        //         ], Response::HTTP_FORBIDDEN);
        // } else {
        //     $user = UserKeys::where([
        //         'key'=> $userApiKey,
        //         'secret' => $userSecret
        //     ])
        //     ->first();

        //     // decrypt user keys
        //     if (empty($user)) {
        //         return response()->json([
        //             'status' => 'error',
        //             'message' => 'Please pay attention to your headers requirement',
        //         ], Response::HTTP_FORBIDDEN);
        //     }

        //     $cleanKey = explode(' ', $user->key);
        //     $cleanSecret = explode(' ', $user->secret);
        //     $userKey = decryptId($cleanKey[1]);
        //     $userSecretDecrypted = decryptId($cleanSecret[1]);

        //     if ($userKey != $user->key_value && $userSecretDecrypted != $user->secret_value) {
        //         return response()->json([
        //             'status' => 'error',
        //             'message' => 'Please pay attention to your headers requirement',
        //         ], Response::HTTP_FORBIDDEN);
        //     }
        //     return $next($request);
        // }
    }
}
