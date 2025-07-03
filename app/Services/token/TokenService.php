<?php
namespace App\Services\Token;

use App\Enum\ResponseCode;
use Illuminate\Support\Facades\Cookie;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class TokenService implements ITokenService
{
  public function refreshToken()
  {
    $refresh_token = Cookie::get('refresh_token');
    if (!$refresh_token) {
      throw new \Exception('Refresh-token is invalid');
    }
    JWTAuth::setToken($refresh_token);
    $new_access_token = JWTAuth::refresh();
    return ['status' => ResponseCode::SUCCESS, 'new_access_token' => $new_access_token];
  }
}