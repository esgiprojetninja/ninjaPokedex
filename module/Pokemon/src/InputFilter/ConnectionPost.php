<?php
namespace Pokemon\InputFilter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;
use Zend\Validator\Csrf;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Identical;

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

        $csrf = new Input('csrf');
        $csrf->setRequired(true);
        
        // $csrf->setValidatorChain($this->getCsrfValidatorChain());
        var_dump($login->getValue());
        var_dump($password->getValue());
        var_dump($csrf->getValue());
        $this->add($login);
        $this->add($password);
        $this->add($csrf);
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

}
