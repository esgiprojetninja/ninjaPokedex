<?php
namespace Pokemon\InputFilter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;
use Zend\I18n\Validator\Alnum;

class ConnectionPost extends InputFilter
{

    public function __construct() {
        $login = new Input('login');
        $login->setRequired(true);
        $login->setFilterChain($this->getStringTrimFilterChain());
        $login->setValidatorChain($this->getLoginValidatorChain());

        $password = new Input('password');
        $password->setRequired(true);
        $password->setFilterChain($this->getStringTrimFilterChain());
        $password->setValidatorChain($this->getPasswordValidatorChain());

        $password_confirm = new Input('confirm_password');
        $password_confirm->setRequired(true);
        $password_confirm->setFilterChain($this->getStringTrimFilterChain());
        $password_confirm->setValidatorChain($this->getPasswordConfirmValidatorChain($password));


        $password = new Input('password');
        $password->setRequired(true);
        $password->setFilterChain($this->getStringTrimFilterChain());
        $password->setValidatorChain($this->getPasswordValidatorChain());

        $this->add($login);
        $this->add($password);
        $this->add($password_confirm);
    }

    protected function getStringTrimFilterChain() {
        $filterChain = new FilterChain();
        $filterChain->attach(new StringTrim());
        return $filterChain;
    }

    protected function getLoginValidatorChain() {
        $stringLength = new StringLength();
        $stringLength->setMin(5);
        $stringLength->setMax(50);
        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Alnum(true));
        $validatorChain->attach($stringLength);
        return $validatorChain;
    }

    protected function getPasswordValidatorChain() {
        $stringLength = new StringLength();
        $stringLength->setMin(8);
        $stringLength->setMax(50);
        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Alnum(true));
        $validatorChain->attach($stringLength);
        return $validatorChain;
    }

    protected function getPasswordConfirmValidatorChain($password) {
        $validatorChain = new ValidatorChain();
        $validatorChain->attach($password);
        return $validatorChain;
    }

}
