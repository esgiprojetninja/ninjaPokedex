<?php
namespace User\Controller;

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialisez le contrôleur et l'action ici */
    }

    public function indexAction()
    {
        var_dump("hello moto");
    }
}
