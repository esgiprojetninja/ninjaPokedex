<?php
namespace Pokemon\Repository;

use Pokemon\Entity\Admin;
use Zend\Crypt\Password\Bcrypt;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;

class AdminRepositoryImpl implements AdminRepository {
    use AdapterAwareTrait;
    public function add(Admin $admin)
    {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
          ->values([
            'login'             => $admin->getLogin(),
            'status'            => 1,
            'password'          => $this->generatePassword($admin->getPassword()),
            'date_created'      => time()
          ])->into('admin');
          $statement = $sql->prepareStatementForSqlObject($insert);
          $statement->execute();
    }
    public function generatePassword($clearPassword)
    {
        // composer require zendframework/zend-crypt
        $encrypter = new Bcrypt();
        $encrypter->setCost(12);
        return $encrypter->create($clearPassword);
    }
    public function getAuthenticationAdapter()
    {
        $callback = function($encryptedPassword, $clearTextPassword) {
            $encrypter = new Bcrypt();
            $encrypter->setCost(12);
            return $encrypter->verify($clearTextPassword, $encryptedPassword);
        };
        $authenticationAdapter = new CallbackCheckAdapter(
            $this->adapter,
            'admin', // name of table
            'login', // field name
            'password',
            $callback
        );
        return $authenticationAdapter;
    }
}
