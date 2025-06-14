<?php
namespace App\Services\Token;

use Illuminate\Support\Facades\Cookie;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

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
}