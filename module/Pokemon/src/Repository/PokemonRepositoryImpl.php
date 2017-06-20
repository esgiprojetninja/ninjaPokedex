<?php
namespace Pokemon\Repository;

use Zend\Hydrator\Aggregate\AggregateHydrator;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Adapter\AdapterAwareTrait;

use Pokemon\Entity\Hydrator\PokemonHydrator;
use Pokemon\Repository\PokemonRepository;
use Pokemon\Entity\Pokemon;
use Pokemon\Entity\Location;
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
          $typeNumber = 2;
        }else{
          $type = $type1;
          $typeNumber = 1;
        }
        $insert = $sql->insert()
        ->values([
          'id_pokemon'  => $pokemon->getIdPokemon(),
          'id_type'     => $type,
          'type_number' => $typeNumber
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

  public function updateTypes(Pokemon $pokemon, $type1, $type2) {
    try {
      $this->adapter
      ->getDriver()
      ->getConnection()
      ->beginTransaction();
      $sql = new \Zend\Db\Sql\Sql($this->adapter);

      if($this->typeAllreadyExist($pokemon, '1')){
        if($type1 != NULL){
          $update = $sql->update();
          $update->table('pokemon_has_type');
          $update->set( ['id_type' => $type1] );
          $update->where( ['id_pokemon' => $pokemon->getIdPokemon(), 'type_number' => '1'] );

          $statement = $sql->prepareStatementForSqlObject($update);
          $statement->execute();  
        }
      }else{
        $insert = $sql->insert()
        ->values([
          'id_pokemon'  => $pokemon->getIdPokemon(),
          'id_type'     => $type1,
          'type_number' => '1'
        ])
        ->into('pokemon_has_type');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
      }
      if($this->typeAllreadyExist($pokemon, '2')){
        if($type2 != NULL){
          $update = $sql->update();
          $update->table('pokemon_has_type');
          $update->set( ['id_type' => $type2] );
          $update->where( ['id_pokemon' => $pokemon->getIdPokemon(), 'type_number' => '2'] );

          $statement = $sql->prepareStatementForSqlObject($update);
          $statement->execute();
        }
      }else{
        $insert = $sql->insert()
        ->values([
          'id_pokemon'  => $pokemon->getIdPokemon(),
          'id_type'     => $type2,
          'type_number' => '2'
        ])
        ->into('pokemon_has_type');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
      }
      $this->adapter->getDriver()
      ->getConnection()
      ->commit();
    }catch (\Exception $e) {
      echo $e->getMessage();
      $this->adapter->getDriver()
      ->getConnection()->rollback();
    }
  }

  public function typeAllreadyExist(Pokemon $pokemon, $typeNumber){
    try {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->from('pokemon_has_type');
      $select->where(array('id_pokemon' => $pokemon->getIdPokemon(), 'type_number' => $typeNumber));

      $statement = $sql->prepareStatementForSqlObject($select);
      $r = $statement->execute();

      $resultSet = new ResultSet;
      $resultSet->initialize($r);

      foreach ($resultSet as $pokemon) {
        return true;
      }
    } catch (\Exception $e) {
      echo $e->getMessage();
      $this->adapter->getDriver()
      ->getConnection()->rollback();
    }
    return false;
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

  public function signal(Location $location) {
    $return = false;
    try {
      $this->adapter
      ->getDriver()
      ->getConnection()
      ->beginTransaction();
      $sql = new \Zend\Db\Sql\Sql($this->adapter);

      $insert = $sql->insert()
      ->values([
        'longitude' => $location->getLongitude(),
        'latitude'   => $location->getLatitude(),
        'id_pokemon' => $location->getIdPokemon(),
        'date_created' => $location->getDateCreated(),
      ])
      ->into('location');
      $statement = $sql->prepareStatementForSqlObject($insert);
      $statement->execute();
      $this->adapter->getDriver()
      ->getConnection()
      ->commit();

      $return = true;

    } catch (\Exception $e) {
      echo $e->getMessage();
      $this->adapter->getDriver()
      ->getConnection()->rollback();
    }
    return $return;
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

      foreach ($resultSet as $pokemon) {
        $types = $this->getTypes($pokemon['id_pokemon']);
        $pokemon =  array_merge((array) $pokemon, $types);
        $pokemon = PokemonsController::setPokemon($pokemon);
      }
      return $pokemon;
    } catch ( \Exception $e ) {
      echo $e->getMessage();
    }
  }

  public function update($id, $data) {
    $return = false;
    $pokemon = $this->findById($id);
    try {
      $this->adapter
      ->getDriver()
      ->getConnection()
      ->beginTransaction();
      $sql = new \Zend\Db\Sql\Sql($this->adapter);

      $types = ['type1', 'type2'];
      $typeToUpdate = [];
      $updateType = false;
      foreach($types as $type){
        if(array_key_exists($type,$data)){
          $updateType = true;
          $typeToUpdate[$type] = $data[$type];
          unset($data[$type]);
        }else if($type == 'type1'){
          $typeToUpdate[$type] = $pokemon->getType1();
        }else if($type == 'type2'){
          $typeToUpdate[$type] = $pokemon->getType2();
        }else{
          $typeToUpdate[$type] = NULL;
        }
      }

      var_dump($typeToUpdate);

      if($updateType){
        $this->updateTypes($pokemon, $typeToUpdate['type1'], $typeToUpdate['type2']);
      }

      $update = $sql->update();
      $update->table('pokemon');
      $update->set($data);
      $update->where( array( 'id_pokemon' => $id ) );

      $statement = $sql->prepareStatementForSqlObject($update);
      $statement->execute();
      $this->adapter->getDriver()
      ->getConnection()
      ->commit();

      $return = true;
    } catch (\Exception $e) {
      echo $e->getMessage();
      $this->adapter->getDriver()
      ->getConnection()->rollback();
    }
    return $return;
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

  public function deleteTypes($pokemonId) {
    $sql = new \Zend\Db\Sql\Sql($this->adapter);
    $delete = $sql->delete()
    ->from('pokemon_has_type')
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
