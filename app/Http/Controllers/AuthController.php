<?php

namespace App\Http\Controllers;

use App\Enum\ResponseCode;
use App\Helpers\Response;
use App\Http\Requests\LoginByUsernameRequest;
use App\Models\UserAccount;
use App\Services\Auth\IAuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $iAuthService;
    public function __construct(IAuthService $iAuthService)
    {
        $this->iAuthService = $iAuthService;
    }
    public function loginByUsername(LoginByUsernameRequest $request)
    {
        try {
            $credentials = $request->validated();
            $result = $this->iAuthService->loginByUsername($credentials);
            if ($result['statusCode'] === ResponseCode::SUCCESS) {
                return Response::success(['access_token' => $result['token']], 'Login Success', ResponseCode::SUCCESS)
                    ->cookie('access_token', $result['token'], 60 * 15, '/', null, false, true);
                ;
            } else {
                return Response::error('Login Failed', ResponseCode::UNAUTHORIZED);
            }
        } catch (\Throwable $th) {
            return Response::error(ResponseCode::INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }
}
