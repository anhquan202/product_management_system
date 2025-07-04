<?php

namespace App\Http\Middleware;

use App\Enum\ResponseCode;
use App\Helpers\Response as HelpersResponse;
use App\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $requiredRoles): Response
    {
        try {
            $userRoles = $request->get('auth_roles', []);
            $requiredRoles = explode(',', $requiredRoles);
            if (in_array(RoleEnum::SUPERADMIN->value, $userRoles)) {
                return $next($request);
            }
            if (empty(array_intersect($userRoles, $requiredRoles))) {
                return HelpersResponse::error(ResponseCode::FORBIDDEN, 'You do not have the required role');
            }
        } catch (\Throwable $th) {
            return HelpersResponse::error(ResponseCode::INTERNAL_SERVER_ERROR, $th->getMessage());
        }

        return $next($request);
    }
}
