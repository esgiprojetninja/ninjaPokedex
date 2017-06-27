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

        $submit = new Element\Submit('submit');
        $submit->setValue('Se connecter');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($login);
        $this->add($password);
        $this->add($submit);
        $this->add([
            'type' => Element\Csrf::class,
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                   'timeout' => 180,
                ],
            ]
        ]);
    }
}
