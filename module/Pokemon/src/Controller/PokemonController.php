<?php
namespace Pokemon\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class PokemonController extends AbstractRestfulController {

    protected $pokemonService;

    function __construct($pokemonService) {
        $this->pokemonService = $pokemonService;
    }

    function getListAction() {
        # code...
    }

    function getAction() {
        return new JsonModel(
            array("data" => ["blabla"])
        );
    }

    function createAction($data) {
        # code...
    }

    function updateAction($id, $data) {
        # code...
    }

    function deleteAction($id) {
        # code...
    }
}
