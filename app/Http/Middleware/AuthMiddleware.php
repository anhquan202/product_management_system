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
            return HelpersResponse::error('Unauthorized - Token not found', ResponseCode::UNAUTHORIZED);
        }

        try {
            // JWTAuth giờ sẽ dùng model UserAccount nhờ config/jwt.php
            $userAccount = JWTAuth::setToken($token)->authenticate();

            if (!$userAccount) {
                return HelpersResponse::error('Unauthorized - Invalid user', ResponseCode::UNAUTHORIZED);
            }

            // Đính kèm nếu controller cần
            $request->merge(['auth_user' => $userAccount]);
        } catch (\Exception $e) {
            return HelpersResponse::error('Unauthorized - Token error', ResponseCode::UNAUTHORIZED);
        }

        return $next($request);
    }
}
