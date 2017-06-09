<?php
namespace Pokemon\Repository;

use Zend\Hydrator\Aggregate\AggregateHydrator;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Adapter\AdapterAwareTrait;

use Pokemon\Entity\Hydrator\PokemonHydrator;
use Pokemon\Repository\PokemonRepository;
use Pokemon\Entity\Pokemon;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

class PokemonRepositoryImpl implements PokemonRepository
{
    use AdapterAwareTrait;

    public function save(Pokemon $pokemon) {
      var_dump($pokemon);
      try {
          $this->adapter
            ->getDriver()
            ->getConnection()
            ->beginTransaction();
            $sql = new \Zend\Db\Sql\Sql($this->adapter);
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
         } catch (\Exception $e) {
           echo $e->getMessage();
              $this->adapter->getDriver()
                ->getConnection()->rollback();
         }
    }

    public function getAll() {
      try {
          $this->adapter->getDriver()
          ->getConnection()
          ->beginTransaction();
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
              $select = $sql->select();
              $select->from(['t' => 'type']);
              $select->join(
                ['p' => 'pokemon_has_type'],
                'p.id_type = t.id_type'
              );
              $select->where(array('id_pokemon' => $pokemon['id_pokemon']));

              $statement = $sql->prepareStatementForSqlObject($select);
              $r = $statement->execute();

              $resultSet2 = new ResultSet;
              $resultSet2->initialize($r);
              $types = [];
              $idType = 0;
              foreach ($resultSet2 as $type) {
                $idType++;
                $types['type'.$idType] = $type['id_type'];
              }
              $pokemons[] = (object) array_merge((array) $pokemon, $types);
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
    public function findById($pokemonId) {
      try {
        $this->adapter->getDriver()
          ->getConnection()
          ->beginTransaction();
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
          $this->adapter->getDriver()
            ->getConnection()
            ->rollback();
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
}
