<?php
namespace Blog\InputFilter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;
use Zend\I18n\Validator\Alnum;

class AddPost extends InputFilter
{

    public function __construct()
    {
        $title = new Input('title');
        $title->setRequired(true);
        $slug = new Input('slug');
        $slug->setRequired(true);
        $content = new Input('content');
        $content->setRequired(true);
        $this->add($title);
        $this->add($slug);
        $this->add($content);
    }
    
}
