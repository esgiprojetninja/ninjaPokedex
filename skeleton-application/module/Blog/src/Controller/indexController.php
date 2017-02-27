<?php

namespace Blog\Controller;

use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController {
    public function __construct() {

    }

    public function indexAction () {
        $variables = [

        ];
        return new ViewModel($variables);
    }

}
