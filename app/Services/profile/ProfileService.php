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

  public function getProfile()
  {
    $user_id = $this->getUserId();
    return Users::find($user_id);
  }

  public function updateProfile(array $data)
  {
    $user = Users::findOrFail($this->getUserId());
    $user->update($data);
    return $user;
  }

  private function getUserId()
  {
    try {
      $payload = $this->iTokenService->getPayload();
      $user_id = $payload['users']['user_id'];
      return $user_id;
    } catch (\Exception $e) {
      throw new \Exception('Failed to get user ID from token: ' . $e->getMessage());
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}