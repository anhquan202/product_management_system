<?php
namespace App\Services\User;
interface IUserService
{
  public function getUserById(string $user_id);
}