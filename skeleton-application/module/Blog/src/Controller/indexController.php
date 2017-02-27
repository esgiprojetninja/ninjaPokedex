<?php

namespace Blog\Controller;

use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function indexAction () {
        $variables = [

        ];
        return new ViewModel($variables);
    }

}
