<?php
namespace Pokemon\Service;

use Pokemon\Entity\Admin;
use Zend\Authentication\AuthenticationService;

class AdminServiceImpl implements AdminService {
    protected $adminRepository;

    public function add(Admin $admin) {
        $this->adminRepository->add($admin);
    }
    public function getAdminRepository() {
        return $this->adminRepository;
    }
    public function setAdminRepository($adminRepository) {
        $this->adminRepository = $adminRepository;
    }
    public function getAuthenticationService() {
        $authenticationAdapter = $this->adminRepository->getAuthenticationAdapter();
        return new AuthenticationService(null, $authenticationAdapter);
    }
    public function login($login, $password) {
        $authenticationService = $this->getAuthenticationService();
        $authenticationAdapter = $authenticationService->getAdapter();
        $authenticationAdapter->setIdentity($login);
        $authenticationAdapter->setCredential($password);
        $result = $authenticationService->authenticate();
        if ($result->isValid()) {
            $identityObject = $authenticationAdapter->getResultRowObject(
              null,
              ['password'] // exclude sensitive data
            );
            $authenticationService->getStorage()->write($identityObject);
            return true;
        }
        return false;
    }
}
