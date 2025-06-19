<?php
namespace App\Services\User;

interface IUserService
{
  public function getUsers();
  public function getUserById(string $user_id);
}