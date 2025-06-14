<?php
namespace App\Services\Profile;
interface IProfileService
{
  public function getProfile();
  public function updateProfile(array $data);
}