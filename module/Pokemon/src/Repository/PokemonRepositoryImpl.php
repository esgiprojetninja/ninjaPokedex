<?php
namespace Pokemon\Repository;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Adapter\AdapterAwareTrait;

use Pokemon\Repository\PokemonRepository;
use Pokemon\Entity\Pokemon;
use Pokemon\Entity\Hydrator\PokemonHydrator;
use Pokemon\Entity\Location;
use Pokemon\Entity\Type;
use Pokemon\Controller\PokemonsController;

use Pokemon\Service\ImageManager;

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
      $verifPokemon = $this->verifPokemonInsert($pokemon);

      $verifPokemon['error'] = FALSE;
      if($verifPokemon['error'] == TRUE){
        return $verifPokemon['message'];
      }else{
        $type1 = $pokemon->getType1();
        $type2 = $pokemon->getType2();

        if($type1 == $type2){
          return "Les deux types sont identiques";
        }

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

        $this->saveTypes($this->getPokemonByName($pokemon->getName()), $type1, $type2);
        return "success";
      }
    } catch (\Exception $e) {
      return $e->getMessage();
      $this->adapter->getDriver()
      ->getConnection()->rollback();
    }
  }

  public function saveTypes(Pokemon $pokemon, $type1, $type2) {
    try {
      $type1 = ((int) $type1 <= 0 ) ? NULL : $type1;
      $type2 = ((int) $type2 <= 0 ) ? NULL : $type2;
      if ( $type1 == NULL && $type2 != NULL ) {
          $type1 = $type2;
          $type2 = NULL;
      }
      if ( $type2 == $type1 )
          $type2 = NULL;
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
      return $e->getMessage();
      $this->adapter->getDriver()
      ->getConnection()->rollback();
    }
  }

  public function updateTypes(Pokemon $pokemon, $type1, $type2) {
    try {
      $type1 = ((int) $type1 <= 0 ) ? NULL : $type1;
      $type2 = ((int) $type2 <= 0 ) ? NULL : $type2;

      if ( $type1 == NULL ) {
          $this->deleteTypes($pokemon->getIdPokemon());
          if ( $type1 == NULL && $type2 != NULL ) {
              $type1 = $type2;
              $type2 = NULL;
          }
      }
      else if ( $type2 == NULL )
          $this->deleteTypes($pokemon->getIdPokemon());
      else if ( $type2 == $type1 )
          $type2 = NULL;
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
      return $e->getMessage();
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
      return $e->getMessage();
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
        $types["type"] = [];
        $typesTemp = $this->getTypes($pokemon['id_pokemon']);
        foreach($typesTemp as $type){
          if($type != NULL){
            $typeData = $this->getTypeInformation($type);
            $types["type"][] = ["nom_type" => $typeData->getNameType(), "color" => $typeData->getColor()];
          }
        }
        $pokemons[] = (object) array_merge((array) $pokemon, $types);
      }
      foreach ($pokemons as $poke) {
          $evolutions = $this->getPokemonEvolutions($pokemons, $poke);
          foreach ($evolutions as $evo) {
              $next_evolutions = $this->getPokemonEvolutions($pokemons, $evo);
              $evo->evolutions = ((bool) count($next_evolutions)) ? $next_evolutions : false;
          }
          $poke->evolutions = ((bool) count($evolutions)) ? $evolutions : false;
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
      $now = date('Y-m-d H:i:s');
      $timezone = 'Europe/Paris';
      date_default_timezone_set($timezone);
      $timestamp = strtotime($now);
      $local_time = $timestamp + date('Z');
      $local_date = date('Y-m-d H:i:s', $local_time);

      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select()
          ->from(
              ['l'=>'location'],
              ['lat'=>'latitude', 'lng'=>'longitude', 'id_pokemon', 'date_created']
          )
          ->join(
              ['p'=>'pokemon'],
              'p.id_pokemon = l.id_pokemon',
              ['icon'=>'image']
          )
          ->where("date_created <= '".$local_date."' AND date_created >= DATE_ADD('".$local_date."', INTERVAL -30 MINUTE)");

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
      return $e->getMessage();
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
      $this->adapter->getDriver()
      ->getConnection()->rollback();
      return $e->getMessage();
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

      $pokemon = NULL;
      foreach ($resultSet as $pokemon) {
        $types = $this->getTypes($pokemon['id_pokemon']);
        $pokemon =  array_merge((array) $pokemon, $types);
      }
      return $pokemon;
    } catch ( \Exception $e ) {
      return $e->getMessage();
    }
  }
  /**
  * @return Pokemon|null
  **/
  public function findByIdNational($pokemonId) {
    try {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->from('pokemon');
      $select->where(array('id_national' => $pokemonId));

      $statement = $sql->prepareStatementForSqlObject($select);
      $r = $statement->execute();

      $resultSet = new ResultSet;
      $resultSet->initialize($r);

      $pokemon = NULL;
      foreach ($resultSet as $pokemon) {
        $types = $this->getTypes($pokemon['id_pokemon']);
        $pokemon =  array_merge((array) $pokemon, $types);
      }
      return $pokemon;
    } catch ( \Exception $e ) {
      return $e->getMessage();
    }
  }

  private function updatePokemonsIdParent($old_id_parent, $new_id_parent)
  {
    try {
      $this->adapter
      ->getDriver()
      ->getConnection()
      ->beginTransaction();
      $sql = new \Zend\Db\Sql\Sql($this->adapter);

      $update = $sql->update();
      $update->table('pokemon');
      $update->set(array('id_parent' => $new_id_parent));
      $update->where(array( 'id_parent' => $old_id_parent));

      $statement = $sql->prepareStatementForSqlObject($update);
      $statement->execute();
      $this->adapter->getDriver()
      ->getConnection()
      ->commit();

      return true;
    } catch (\Exception $e) {
      return $e->getMessage();
      $this->adapter->getDriver()
      ->getConnection()->rollback();
    }
  }

  public function update($id, $data) {
    $return = false;
    $pokemon = PokemonsController::setPokemon($this->findById($id));
    $old_id_national = intval($pokemon->getIdNational());
    $new_id_national = intval($data['id_national']);
    try {
      $this->adapter
      ->getDriver()
      ->getConnection()
      ->beginTransaction();
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $data['id_parent'] = ( (int) $this->findByIdNational($data['id_parent']) != null ) ? $data['id_parent'] : null;
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

      if($updateType){
        if($typeToUpdate['type1'] == $typeToUpdate['type2']){
          return "Les deux types sont identiques";
        }else{
          $this->updateTypes($pokemon, $typeToUpdate['type1'], $typeToUpdate['type2']);
        }
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
      if ( $old_id_national != $new_id_national ) {
        $dependencies_update = $this->updatePokemonsIdParent($old_id_national, $new_id_national);
        if ( true === $dependencies_update)
          return true;
        return $dependencies_update;
      }
      $return = true;
    } catch (\Exception $e) {
      return $e->getMessage();
      $this->adapter->getDriver()
      ->getConnection()->rollback();
    }
    return $return;
  }

  public function delete($pokemonId) {
    $poke = $this->findById($pokemonId);
    if ( $poke == null )
        return false;
    $old_id_national = intval($poke['id_national']);
    try {
      $this->adapter
      ->getDriver()
      ->getConnection()
      ->beginTransaction();
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $delete = $sql->delete()
      ->from('pokemon')
      ->where([
        'id_pokemon' => $pokemonId
      ]);

      $statement = $sql->prepareStatementForSqlObject($delete);
      $statement->execute();
      $this->adapter->getDriver()
      ->getConnection()
      ->commit();

      $this->updatePokemonsIdParent($old_id_national, null);
      $this->deleteTypes($pokemonId);

      $img = explode("/", $poke['image']);
      $img = $img[count($img)-1];

      $imgManager = new ImageManager();
      $imgManager->deteFileByName($img);

      return true;
    } catch (\Exception $e) {
      $this->adapter->getDriver()
      ->getConnection()->rollback();
      return $e->getMessage();
    }
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

  public function dispo($idNational) {
    try {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);

      //Get pokemon infos
      $select = $sql->select();
      $select->from('pokemon');
      $select->columns(['name','id_parent','id_pokemon', 'id_national']);

      $statement = $sql->prepareStatementForSqlObject($select);
      $r = $statement->execute();

      $resultSet = new ResultSet;
      $resultSet->initialize($r);
      $pokemons = [];
      $notDispo = [];
      foreach ($resultSet as $pokemon) {
        //Toutes les familles avec 2 evolutions successives sont retirés, comme Salameche Reptincel Dracaufeu
        $firstPokemon = $pokemon->id_national;
        $secondPokemon = $this->getByIdParent($firstPokemon);
        if(count($secondPokemon) > 0){
          $secondPokemon['id_national'];
          $thirdPokemon = $this->getByIdParent($secondPokemon['id_national']);
            if(count($thirdPokemon) > 0){
              $secondPokemon = $secondPokemon['id_national'];
              $thirdPokemon = $thirdPokemon['id_national'];
              $notDispo[] = $firstPokemon;
              $notDispo[] = $secondPokemon;
              $notDispo[] = $thirdPokemon;
            }
        }
        $pokemons[] = $pokemon;
      }
      if($idNational != 0){
        $notDispo[] = $idNational;
        $pokemonParent = ($this->getByIdParent($idNational));
        if(count($pokemonParent) > 0){
          if (!in_array($pokemonParent['id_national'], $notDispo)){
            $notDispo[] = $pokemonParent['id_national'];
          }
        }
      }
      foreach($pokemons as $key=>$pokemon){
        if(in_array($pokemon->id_national, $notDispo)){
          unset($pokemons[$key]);
        }
      }
      return $pokemons;
    } catch ( \Exception $e ) {
      $this->adapter->getDriver()
      ->getConnection()
      ->rollback();
    }
  }

  /**
  * @return Pokemon|null
  **/
  public function getByIdParent($pokemonId) {
    try {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->from('pokemon');
      $select->where(array('id_parent' => $pokemonId));

      $statement = $sql->prepareStatementForSqlObject($select);
      $r = $statement->execute();

      $resultSet = new ResultSet;
      $resultSet->initialize($r);

      $pokemon = NULL;
      foreach ($resultSet as $pokemon) {
        $pokemon =  $pokemon;
      }
      return $pokemon;
    } catch ( \Exception $e ) {
      return $e->getMessage();
    }
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

  protected function getTypeInformation($idType){
    try {
      $sql = new \Zend\Db\Sql\Sql($this->adapter);
      $select = $sql->select();
      $select->from('type');
      $select->where(array('id_type' => $idType));

      $statement = $sql->prepareStatementForSqlObject($select);
      $r = $statement->execute();

      $resultSet = new ResultSet;
      $resultSet->initialize($r);

      foreach($resultSet as $type){
        return PokemonsController::setType($type);
      }
    } catch ( \Exception $e ) {
      return $e->getMessage();
    }
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
      return $e->getMessage();
    }
  }

  public function verifPokemonInsert(Pokemon $pokemon){
    //Verif name
    if($this->verifPokemonName($pokemon->getName()) > 0 || $pokemon->getName() == NULL){
      return ["error" => TRUE, "message" => "Nom pokemon déjà existant ou vide."];
    }
    //Verif id_national
    if($this->verifPokemonIdNationnal($pokemon->getIdNational()) > 0 || $pokemon->getIdNational() == NULL){
      return ["error" => TRUE, "message" => "Id national déjà existant ou vide."];
    }
    //Verif type différent
    return ["error" => FALSE];
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
      return $e->getMessage();
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
      return $e->getMessage();
    }
  }

  public function hydrateWithRelatives(Pokemon $pokemon)
  {
      $all_pokemons = $this->getAll();
      function findById($all_pokemons, $id_parent)
      {
          $pokeHydrator = new PokemonHydrator();
          foreach ($all_pokemons as $poke) {
              $poke = (array) $poke;
              if ( (int) $poke['id_national'] == (int) $id_parent )
                  return $pokeHydrator->hydrate( $poke, new Pokemon());
          }
          return null;
      }

      function getPokemonEvolutions($all_pokemons, $id_national)
      {
          $pokeHydrator = new PokemonHydrator();
          $evolutions = [];
          foreach ($all_pokemons as $poke_evo) {
              $poke_evo = (array) $poke_evo;
              if ( (int) $poke_evo['id_parent'] == (int) $id_national )
                  $evolutions[] = $pokeHydrator->hydrate( $poke_evo, new Pokemon());
          }
          return $evolutions;
      }

      if ( $pokemon->getIdParent() != null ) {
          $parent = findById($all_pokemons, $pokemon->getIdParent());
          if ( $parent != null )
              $parent->setParent(findById($all_pokemons, $parent->getIdParent()));
          $pokemon->setParent($parent);
      }

      $pokemon_evolutions = getPokemonEvolutions($all_pokemons, $pokemon->getIdNational());
      foreach ($pokemon_evolutions as $evo) {
          $evo_next = getPokemonEvolutions($all_pokemons, $evo->getIdNational());
          $evo_next = (count($evo_next) > 0) ? $evo_next : null;
          $evo->setEvolutions($evo_next);
      }
      $pokemon_evolutions = (count($pokemon_evolutions) > 0) ? $pokemon_evolutions : null;
      $pokemon->setEvolutions($pokemon_evolutions);
      return $pokemon;
  }

  protected function getPokemonEvolutions($pokemons, $pokemon) {
      $evolutions = [];
      foreach ($pokemons as $poke) {
          if ( (int) $poke->id_parent == (int) $pokemon->id_national )
              $evolutions[] = $poke;
      }
      return $evolutions;
  }

}
