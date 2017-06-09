<?php
namespace Pokemon\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class PokemonsController extends AbstractRestfulController {

    protected $pokemonService;

    public function __construct($pokemonService) {
        $this->pokemonService = $pokemonService;
    }

    public function signalAction() {
        var_dump("signal Action !! isPost: ", $this->request->isPost());
        var_dump("signal Action !! getPost: ", $this->request->getPost());
        exit;
    }

    public function get($id) {
        return new JsonModel(
            array("get" => $id)
        );
    }
    public function getList() {
        $pokemons = $this->pokemonService->getAll();
        return new JsonModel(
            array($pokemons)
        );
    }
    public function create($data) {
        return new JsonModel(
            array("create" => $data)
        );
    }
    public function update($id, $data) {
        return new JsonModel(
            array("update" => $id)
        );
    }
    public function delete($id) {
        return new JsonModel(
            array("delete" => $id)
        );
    }
    public function methodNotAllowed() {
        $this->response->setStatusCode(
            \Zend\Http\PhpEnvironment\Response::STATUS_CODE_405
        );
        throw new Exception('Method Not Allowed');
    }

    protected function pokemonToArray($pokemon){
        return[
          'id_pokemon'    => $pokemon->getIdPokemon(),
          'name'          => $pokemon->getName(),
          'description'   => $pokemon->getDescription(),
          'localisation'  => $pokemon->getLocalisation(),
          'id_parent'     => $pokemon->getIdParent(),
          'image'         => $pokemon->getImage(),
          'id_national'   => $pokemon->getIdNational()
        ];
    }
}
