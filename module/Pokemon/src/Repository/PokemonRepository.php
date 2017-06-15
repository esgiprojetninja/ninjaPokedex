<?php
namespace Pokemon\Repository;

use Application\Repository\RepositoryInterface;
use Pokemon\Entity\Pokemon;

interface PokemonRepository extends RepositoryInterface
{
    public function save(Pokemon $pokemon);

    public function getAll();
    /**
     * @return Pokemon|null
    **/
    public function findById($pokemonId);

    public function update(Pokemon $pokemon);

    public function delete($pokemonId);

    public function marked();
}
