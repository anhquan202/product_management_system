<?php
namespace App\Services\User;

use App\Models\Users;

class UserService implements IUserService
{
  public function getUsers()
  {
    return Users::all();
  }
  public function getUserById(string $user_id)
  {
    return Users::findOrFail($user_id);
  }
}