<?php
namespace Pokemon\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Connection extends Form
{

    public function __construct() {
        parent::__construct();

        $login = new Element\Text('login');
        $login->setLabel('Identifiant');
        $login->setAttribute('class','form-control');

        $password = new Element\Password('password');
        $password->setLabel('Mot de passe');
        $password->setAttribute('class','form-control');

        $confirm_password = new Element\Password('confirm_password');
        $confirm_password->setLabel('Confirmation de mot de passe');
        $confirm_password->setAttribute('class','form-control');

        $csrf = new Element\Csrf('csrf');
        $csrf->setCsrfValidatorOptions(['timeout' => 600]);

        $submit = new Element\Submit('submit');
        $submit->setValue('Se connecter');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($login);
        $this->add($password);
        $this->add($confirm_password);
        $this->add($csrf);
        $this->add($submit);
    }
}
