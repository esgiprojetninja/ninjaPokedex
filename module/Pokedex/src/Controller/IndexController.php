<?php
namespace Pokedex\Controller;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
    protected $pokedexService;

    public function __construct($service) {
        $this->pokedexService = $service;
    }

    public function indexAction() {
        return new ViewModel();
    }
}
