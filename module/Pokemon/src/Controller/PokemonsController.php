<?php
namespace Pokemon\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Pokemon\Entity\Pokemon;

class PokemonsController extends AbstractRestfulController {

  protected $pokemonService;

  public function __construct($pokemonService) {
    $this->pokemonService = $pokemonService;
  }

  public function get($id) {
    return new JsonModel(
      $this->pokemonService->findById($id)
    );
  }

  public function getList() {
    return new JsonModel(
      $this->pokemonService->getAll()
    );
  }

  public function create($data) {
    try {
      $pokemon = $this->setPokemon($data);
      $message = "error";
      if($this->pokemonService->save($pokemon)){
        $message = "success";
      }
    } catch (\Exception $e) {
      $message = $e->getMessage();
    }
    return new JsonModel([$message]);
  }

  public function update($id, $data) {
    return new JsonModel(
      array("update" => $id)
    );
  }

  public function delete($id) {
    try {
      $this->pokemonService->delete($id);
      $message = 'success';
    } catch (\Exception $e) {
      $message = $e->getMessage();
    }
    return new JsonModel([$message]);
  }

  public function markedAction() {
    return new JsonModel(
      $this->pokemonService->marked()
    );
  }

  public function methodNotAllowed() {
    $this->response->setStatusCode(
      \Zend\Http\PhpEnvironment\Response::STATUS_CODE_405
    );
    throw new Exception('Method Not Allowed');
  }

  public static function setPokemon($data){
    $pokemon = new Pokemon();
    if(isset($data['id_pokemon'])){
      $pokemon->setIdPokemon($data['id_pokemon']);
    }
    $pokemon->setIdNational($data['id_national']);
    $pokemon->setName($data['name']);
    $pokemon->setDescription($data['description']);
    if(strlen($data['id_parent']) == 0 ){
      $pokemon->setIdParent(NULL);
    }else{
      $pokemon->setIdParent($data['id_parent']);
    }
    if(isset($data['type1'])){
      if($data['type1'] != NULL){
        $pokemon->setType1($data['type1']);
      }
    }
    if(isset($data['type2'])){
      if($data['type2'] != NULL){
        $pokemon->setType2($data['type2']);
      }
    }
    $pokemon->setImage($data['image']);
    return $pokemon;
  }

  public function getPokemonByName($name)
  {
    return $this->getByName($name);
  }
}
