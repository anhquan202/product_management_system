<?php

namespace App\Http\Controllers;

use App\Enum\ResponseCode;
use App\Services\Auth\IAuthService;
use App\Services\Token\ITokenService;
use App\Helpers\Response as HelpersResponse;
use App\Http\Requests\LoginByUsernameRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
  protected $iAuthService, $iTokenService;
  public function __construct(IAuthService $iAuthService, ITokenService $iTokenService)
  {
    $this->iAuthService = $iAuthService;
    $this->iTokenService = $iTokenService;
  }
  public function loginByUsername(LoginByUsernameRequest $request)
  {
    try {
      $credentials = $request->validated();
      $result = $this->iAuthService->loginByUsername($credentials);
      if ($result['statusCode'] === ResponseCode::SUCCESS) {
        return HelpersResponse::success(['user' => $result['user_info'], 'access_token' => $result['access_token']], 'Login Success', ResponseCode::SUCCESS)
          ->cookie('refresh_token', $result['refresh_token'], config('jwt.refresh_ttl'), '/', null, false, true);
      }
      return HelpersResponse::error(ResponseCode::NOT_FOUND, 'Sai thông tin đăng nhập!');
    } catch (ModelNotFoundException $e) {
      return HelpersResponse::error(ResponseCode::NOT_FOUND, 'Tài khoản không tồn tại!');
    } catch (\Throwable $th) {
      return HelpersResponse::error(ResponseCode::INTERNAL_SERVER_ERROR, $th->getMessage());
    }
  }

  public function refreshToken()
  {
    try {
      $result = $this->iTokenService->refreshToken();
      if ($result['status'] === ResponseCode::SUCCESS) {
        return HelpersResponse::success($result['new_access_token'], 'Refresh token success');
      } else {
        return HelpersResponse::error(ResponseCode::BAD_REQUEST, $result);
      }
    } catch (\Throwable $th) {
      return HelpersResponse::error(ResponseCode::UNAUTHORIZED, $th->getMessage());
    }
  }
}
