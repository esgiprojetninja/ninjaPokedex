<?php
namespace Pokemon\Repository;
use Application\Repository\RepositoryInterface;
use Pokemon\Entity\Admin;

interface AdminRepository extends RepositoryInterface {
    public function add(Admin $admin);
    public function generatePassword($clearPassword);
    public function getAuthenticationAdapter();
}
