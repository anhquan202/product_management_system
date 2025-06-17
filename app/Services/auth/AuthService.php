<?php
namespace App\Services\Auth;

use App\Enum\ResponseCode;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;

class AuthService implements IAuthService
{
  public function loginByUsername(array $credentials)
  {
    $username = $credentials['username'];
    $password = $credentials['password'];
    $user_account = UserAccount::where('username', '=', $username)->firstOrFail();
    if (!Hash::check($password, $user_account->password)) {
      return ['statusCode' => ResponseCode::UNAUTHORIZED];
    }
    $role_names = $user_account->userRoles->pluck('role.role_name')->toArray();
    $token = auth()->claims(['user_id' => $user_account->user_id, 'roles' => $role_names])->attempt($credentials);
    return ['statusCode' => ResponseCode::SUCCESS, 'token' => $token];
  }
}