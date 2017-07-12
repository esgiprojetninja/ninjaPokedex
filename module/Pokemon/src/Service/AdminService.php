<?php
namespace Pokemon\Service;
use Pokemon\Entity\Admin;
interface AdminService
{
  public function add(Admin $admin);
  public function getAuthenticationService();
  /**
   * @return bool
   */
  public function login($login, $password);
}
