<?php
namespace App\Services\Token;

use App\Enum\ResponseCode;
use Illuminate\Support\Facades\Cookie;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\JWTAuth as JWTAuthJWTAuth;

class TokenService implements ITokenService
{
  public function getPayload()
  {
    try {
      $token = Cookie::get('access_token');
      $payload = JWTAuth::setToken($token)->getPayload();
      return $payload;
    } catch (\Throwable $th) {
      throw $th;
    }
  }
  public function refreshToken()
  {
    try {
      $token = Cookie::get('access_token');
      $new_token = JWTAuth::setToken($token)->refresh();
      Cookie::queue(
        Cookie::make('access_token', $new_token, 15, '/', null, true, true, false, 'Strict')
      );
      return ['status' => ResponseCode::SUCCESS, 'message' => 'Refresh-token is created'];
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}