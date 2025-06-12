<?php
namespace App\Services\User;

use App\Models\Users;

class UserService implements IUserService
{
  public function getUserById(string $user_id)
  {
    return Users::find('user_id', $user_id);
  }
}