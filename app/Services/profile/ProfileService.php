<?php
namespace App\Services\Profile;

use App\Models\Users;
use App\Services\Token\ITokenService;

class ProfileService implements IProfileService
{
  protected $iTokenService;
  /**
   * ProfileService constructor.
   *
   * @param ITokenService $iTokenService
   */

  public function __construct(ITokenService $iTokenService)
  {
    $this->iTokenService = $iTokenService;
  }

  public function getProfile($user_id)
  {
    return Users::find($user_id);
  }

  public function updateProfile(string $user_id, array $data)
  {
    $user = Users::findOrFail($user_id);
    $user->update($data);
    return $user;
  }
}