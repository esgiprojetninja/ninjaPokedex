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
    }

    public function getAll() {
      try {
        $this->adapter->getDriver()
          ->getConnection()
          ->beginTransaction();
          $sql = new \Zend\Db\Sql\Sql($this->adapter);
          $select = $sql->select();
          $select->from('pokemon');

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

    }
}
