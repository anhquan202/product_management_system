<?php
namespace App\Services\Auth;

use App\Models\Users;
use App\Enum\ResponseCode;
use App\Models\UserAccount;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Services\Token\ITokenService;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService implements IAuthService
{
  protected $iTokenService;
  public function __construct(ITokenService $iTokenService)
  {
    $this->iTokenService = $iTokenService;
  }
  public function loginByUsername(array $credentials)
  {
    $username = $credentials['username'];
    $password = $credentials['password'];
    $user_account = UserAccount::where('username', '=', $username)->firstOrFail();
    if (!Hash::check($password, $user_account->password)) {
      return ['statusCode' => ResponseCode::UNAUTHORIZED];
    }
    $user_after_Login = $this->getUserLoggedIn($user_account->user_id);

    //create access_token
    $access_token = auth()->claims(['users' => $user_after_Login])->attempt($credentials);

    // create refresh_token
    $data = [
      'exp' => time() + config('jwt.refresh_ttl') * 60,
      'jti' => Str::uuid(),
      'sub' => $user_account->user_id,
      'user' => $user_after_Login
    ];
    $refresh_token = JWTAuth::getJWTProvider()->encode($data);

    return [
      'statusCode' => ResponseCode::SUCCESS,
      'access_token' => $access_token,
      'refresh_token' => $refresh_token,
      'user_info' => $user_after_Login
    ];
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