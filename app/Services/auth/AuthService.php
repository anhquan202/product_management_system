<?php
namespace App\Services\Auth;

use App\Enum\ResponseCode;
use App\Models\UserAccount;
use App\Models\UserRole;
use App\Models\Users;
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
    $user_after_Login = $this->getUserLoggedIn($user_account->user_id);
    $token = auth()->claims(['users' => $user_after_Login])->attempt($credentials);
    return ['statusCode' => ResponseCode::SUCCESS, 'token' => $token];
  }
  private function getUserLoggedIn(string $user_id)
  {
    $user = Users::with([
      'userPermissionDetail' => function ($query) {
        $query->select('permission_detail.permission_detail_id', 'permission_detail.permission_key');
      },
      'roles' => function ($query) {
        $query->select('roles.role_id', 'roles.role_name');
      }
    ])->where('user_id', $user_id)->firstOrFail();

    $permissions = $user->userPermissionDetail->pluck('permission_key')->toArray();

    $roles = $user->roles->pluck('role_name')->toArray();

    return [
      'user_id' => $user->user_id,
      'roles' => $roles,
      'permissions' => $permissions
    ];
  }
}