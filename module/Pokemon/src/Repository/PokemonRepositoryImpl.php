<?php
namespace Pokemon\Repository;

use Zend\Hydrator\Aggregate\AggregateHydrator;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Adapter\AdapterAwareTrait;

use Pokemon\Entity\Hydrator\PokemonHydrator;
use Pokemon\Repository\PokemonRepository;
use Pokemon\Entity\Pokemon;

class PokemonRepositoryImpl implements PokemonRepository
{
    use AdapterAwareTrait;

    public function save(Pokemon $pokemon) {
    }

    public function getAll() {

    }

    /**
     * @return Pokemon|null
    **/
    public function findById($pokemonId) {

    }

    public function update(Pokemon $pokemon) {

    }

    public function delete($pokemonId) {

    }
}
