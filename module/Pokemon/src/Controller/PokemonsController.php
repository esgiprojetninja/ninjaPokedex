<?php
namespace Pokemon\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Pokemon\Entity\Pokemon;
use Pokemon\Entity\Location;

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
    try {
      $message = "error";
      if($this->pokemonService->update($id, $data)){
        $message = "success";
      }
    } catch (\Exception $e) {
      $message = $e->getMessage();
    }
    return new JsonModel([$message]);
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

  public function signalAction() {
    try {
      $location = $this->setLocation($_POST);
      $message = "error";
      if($this->pokemonService->signal($location)){
        $message = "success";
      }
    } catch (\Exception $e) {
      $message = $e->getMessage();
    }
    return new JsonModel([$message]);
  }

  public function methodNotAllowed() {
    $this->response->setStatusCode(
      \Zend\Http\PhpEnvironment\Response::STATUS_CODE_405
    );
    throw new Exception('Method Not Allowed');
  }

  public function setLocation($data){
    $location = new Location();

    $now = date('Y-m-d H:i:s');
    $timezone = 'Europe/Paris';
    date_default_timezone_set($timezone);
    $timestamp = strtotime($now);
    $local_time = $timestamp + date('Z');
    $local_date = date('Y-m-d H:i:s', $local_time);


    $location->setIdPokemon($data['id_pokemon']);
    $location->setLatitude($data['latitude']);
    $location->setLongitude($data['longitude']);
    $location->setDateCreated($local_date);
    return $location;
  }

  public static function setPokemon($data){
    var_dump($data);
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
    $pokemon->setImage("http://romainlambot.fr/pokemons/images/".$data['id_national'].".png");
    return $pokemon;
  }

  public function getPokemonByName($name)
  {
    return $this->getByName($name);
  }
}
