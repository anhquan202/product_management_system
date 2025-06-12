<?php
namespace App\Services\Auth;
interface IAuthService
{
  /** Login with available account for superadmin - admin - employee 
   * @param  array $credentials
   * fields: username, password
   */

  public function loginByUsername(array $credentials);
}