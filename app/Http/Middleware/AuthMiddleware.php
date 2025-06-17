<?php

namespace App\Http\Middleware;

use App\Enum\ResponseCode;
use App\Helpers\Response as HelpersResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = Cookie::get('access_token');

        if (!$token) {
            return HelpersResponse::error(ResponseCode::UNAUTHORIZED, 'Unauthorized - Token not found');
        }

        try {
            $payload = JWTAuth::setToken($token)->getPayload();
            $request->merge([
                'auth_user_id' => $payload->get('user_id'),
                'auth_roles' => $payload->get('roles'),
            ]);
        } catch (\Exception $e) {
            return HelpersResponse::error(ResponseCode::UNAUTHORIZED, 'Invalid Token');
        }

        return $next($request);
    }
}
