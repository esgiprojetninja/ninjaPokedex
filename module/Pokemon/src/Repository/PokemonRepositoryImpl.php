<?php
namespace Pokemon\Repository;

use Zend\Hydrator\Aggregate\AggregateHydrator;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Adapter\AdapterAwareTrait;

use Pokemon\Entity\Hydrator\PokemonHydrator;
use Pokemon\Repository\PokemonRepository;
use Pokemon\Entity\Pokemon;
use Pokemon\Controller\PokemonsController;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

class PokemonRepositoryImpl implements PokemonRepository
{
  use AdapterAwareTrait;

  public function save(Pokemon $pokemon) {
    $return = false;
    try {
      $this->adapter
      ->getDriver()
      ->getConnection()
      ->beginTransaction();
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      if($this->verifPokemonInsert($pokemon)){
        $insert = $sql->insert()
        ->values([
          'id_national' => $pokemon->getIdNational(),
          'name'        => $pokemon->getName(),
          'description' => $pokemon->getDescription(),
          'id_parent'   => $pokemon->getIdParent(),
          'image'       => $pokemon->getImage(),
        ])
        ->into('pokemon');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
        $this->adapter->getDriver()
        ->getConnection()
        ->commit();

        $type1 = $pokemon->getType1();
        $type2 = $pokemon->getType2();

        $this->saveTypes($this->getPokemonByName($pokemon->getName()), $type1, $type2);
        $return = true;
      }
    } catch (\Exception $e) {
      echo $e->getMessage();
      $this->adapter->getDriver()
      ->getConnection()->rollback();
    }
    return $return;
  }

  public function saveTypes(Pokemon $pokemon, $type1, $type2) {
    try {
      $this->adapter
      ->getDriver()
      ->getConnection()
      ->beginTransaction();
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $i = 1;

      if($type2 != NULL){
        $i = 2;
      }
      for($k=1; $k <= $i; $k++){
        if($k == 2){
          $type = $type2;
        }else{
          $type = $type1;
        }
        $insert = $sql->insert()
        ->values([
          'id_pokemon' => $pokemon->getIdPokemon(),
          'id_type'    => $type,
        ])
        ->into('pokemon_has_type');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
      }
      $this->adapter->getDriver()
      ->getConnection()
      ->commit();
    } catch (\Exception $e) {
      echo $e->getMessage();
      $this->adapter->getDriver()
      ->getConnection()->rollback();
    }
  }


  public function getAll() {
    try {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);

      //Get pokemon infos
      $select = $sql->select();
      $select->from('pokemon');

      $statement = $sql->prepareStatementForSqlObject($select);
      $r = $statement->execute();

      $resultSet = new ResultSet;
      $resultSet->initialize($r);
      $pokemons = [];
      foreach ($resultSet as $pokemon) {
        //Get type infos
        $types = $this->getTypes($pokemon['id_pokemon']);
        $pokemons[] = (object) array_merge((array) $pokemon, $types);
      }
      return $pokemons;
    } catch ( \Exception $e ) {
      $this->adapter->getDriver()
      ->getConnection()
      ->rollback();
    }
  }

  public function marked() {
    try {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->from('location');

      $statement = $sql->prepareStatementForSqlObject($select);
      $r = $statement->execute();

      $resultSet = new ResultSet;
      $resultSet->initialize($r);

      $locations = [];
      foreach ($resultSet as $location) {
        $locations[] = $location;
      }
      return $locations;
    } catch ( \Exception $e ) {
      echo $e->getMessage();
    }
  }

  /**
  * @return Pokemon|null
  **/
  public function findById($pokemonId) {
    try {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->from('pokemon');
      $select->where(array('id_pokemon' => $pokemonId));

      $statement = $sql->prepareStatementForSqlObject($select);
      $r = $statement->execute();

      $resultSet = new ResultSet;
      $resultSet->initialize($r);

      $pokemons = [];
      foreach ($resultSet as $pokemon) {
        $pokemons[] = $pokemon;
      }
      return $pokemons;
    } catch ( \Exception $e ) {
      echo $e->getMessage();
    }
  }

  public function update(Pokemon $pokemon) {

  }

  public function delete($pokemonId) {
    $sql = new \Zend\Db\Sql\Sql($this->adapter);
    $delete = $sql->delete()
    ->from('pokemon')
    ->where([
      'id_pokemon' => $pokemonId
    ]);
    $statement = $sql->prepareStatementForSqlObject($delete);
    $statement->execute();
  }

  protected function getTypes($idPokemon){
    $sql = new \Zend\Db\Sql\Sql($this->adapter);
    $select = $sql->select();
    $select->from(['t' => 'type']);
    $select->join(
      ['p' => 'pokemon_has_type'],
      'p.id_type = t.id_type'
    );
    $select->where(array('id_pokemon' => $idPokemon));

    $statement = $sql->prepareStatementForSqlObject($select);
    $r = $statement->execute();

    $resultSet = new ResultSet;
    $resultSet->initialize($r);
    $types = [];
    $idType = 0;
    foreach ($resultSet as $type) {
      $idType++;
      $types['type'.$idType] = $type['id_type'];
    }
    if($idType == 1){
      $types['type2'] = NULL;
    }

    return $types;
  }

  public function getPokemonByName($name){
    try {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->from('pokemon');
      $select->where(array('name' => $name));

      $statement = $sql->prepareStatementForSqlObject($select);
      $r = $statement->execute();

      $resultSet = new ResultSet;
      $resultSet->initialize($r);

      foreach($resultSet as $pokemon){
        return PokemonsController::setPokemon($pokemon);
      }
    } catch ( \Exception $e ) {
      echo $e->getMessage();
    }
  }

  public function verifPokemonInsert(Pokemon $pokemon){
    //Verif name
    if($this->verifPokemonName($pokemon->getName()) > 0){
      return false;
    }
    //Verif id_national
    if($this->verifPokemonIdNationnal($pokemon->getIdNational()) > 0){
      return false;
    }
    //Verif type différent
    return true;
  }

  public function verifPokemonName($name){
    try {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->from('pokemon');
      $select->where(array('name' => $name));

      $statement = $sql->prepareStatementForSqlObject($select);
      $r = $statement->execute();

      $resultSet = new ResultSet;
      $resultSet->initialize($r);

      return count($resultSet);
    } catch ( \Exception $e ) {
      echo $e->getMessage();
    }
  }

  public function verifPokemonIdNationnal($idNational){
    try {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->from('pokemon');
      $select->where(array('id_national' => $idNational));

      $statement = $sql->prepareStatementForSqlObject($select);
      $r = $statement->execute();

      $resultSet = new ResultSet;
      $resultSet->initialize($r);

      return count($resultSet);
    } catch ( \Exception $e ) {
      echo $e->getMessage();
    }
  }

}
