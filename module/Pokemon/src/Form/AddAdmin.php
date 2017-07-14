<?php
namespace Pokemon\Form;
use Zend\Form\Form;
use Zend\Form\Element;

class AddAdmin extends Form {
    public function __construct() {
        parent::__construct('add_admin');

        $this->setHydrator(new \Zend\Hydrator\ClassMethods());

        $login = new Element\Text('login');
        $login->setLabel('Identifiant');
        $login->setAttribute('class','form-control');

        $password = new Element\Password('password');
        $password->setLabel('Mot de passe');
        $password->setAttribute('class','form-control');

        $repeatPassword = new Element\Password('repeatPassword');
        $repeatPassword->setLabel('Confirmation du mot de passe');
        $repeatPassword->setAttribute('class', 'form-control');

        $submit = new Element\Submit('submit');
        $submit->setValue('Valider');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($login);
        $this->add($password);
        $this->add($repeatPassword);
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
