<?php
namespace Pokemon\Controller;

use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\MvcEvent;
class AdminController extends AbstractActionController {

    protected $pokemonService;

    /**
     * We override the parent class' onDispatch() method to
     * set an alternative layout for all actions in this controller.
    */
    public function onDispatch(MvcEvent $e)
    {
        // Call the base class' onDispatch() first and grab the response
        $response = parent::onDispatch($e);

        // Set alternative layout
        $this->layout()->setTemplate('layout/layout_admin');

        // Return the response
        return $response;
    }

    public function __construct($pokemonService) {
        $this->pokemonService = $pokemonService;
    }

    public function indexAction() {
        $variables = [
            'posts' => 'oh no'
        ];
        return new ViewModel($variables);
    }
}
