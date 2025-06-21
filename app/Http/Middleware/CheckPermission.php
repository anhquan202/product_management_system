<?php

namespace App\Http\Middleware;

use Closure;
use App\RoleEnum;
use App\Enum\ResponseCode;
use Illuminate\Http\Request;
use App\Helpers\Response as HelpersResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $requiredPermissions): Response
    {
        try {
            $userRoles = $request->get('auth_roles', []);
            $userPermissions = $request->get('auth_permissions', []);
            $requiredPermissions = explode(',', $requiredPermissions);

            if (in_array(RoleEnum::SUPERADMIN->value, $userRoles)) {
                return $next($request);
            }

            if (empty(array_intersect($userPermissions, $requiredPermissions))) {
                return HelpersResponse::error(ResponseCode::FORBIDDEN, 'Permission denied');
            }
        } catch (\Throwable $th) {
            return HelpersResponse::error(ResponseCode::INTERNAL_SERVER_ERROR, $th->getMessage());
        }
        return $next($request);
    }

}
