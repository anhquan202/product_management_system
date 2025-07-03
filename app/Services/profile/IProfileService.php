<?php
namespace App\Services\Profile;
interface IProfileService
{
  public function getProfile($user_id);
  public function updateProfile(string $user_id, array $data);
}