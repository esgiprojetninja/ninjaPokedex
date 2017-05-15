<?php

namespace User\Service;

use User\Entity\User;
use Zend\Authentication\AuthenticationService;

class UserServiceImpl implements UserService {
    protected $userRepository;

    function add(User $user) {
        $this->userRepository->add($user);
    }
    function getUserRepository() {
        return $this->userRepository;
    }
    function setUserRepository($userRepository) {
        $this->userRepository = $userRepository;
    }
    function getAuthenticationService() {
        $authenticationAdapter = $this->userRepository->getAuthenticationAdapter();
        return new AuthenticationService(null, $authenticationAdapter);
    }
    function login($email, $pasword) {
        $authenticationService = $this->getAuthenticationService();
        $authenticationAdapter = $authenticationService->getAdapter();
        $authenticationAdapter->setIdentity($email);
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
