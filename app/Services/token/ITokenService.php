<?php
namespace App\Services\Token;
interface ITokenService
{
  public function getPayload();
  public function refreshToken();
}