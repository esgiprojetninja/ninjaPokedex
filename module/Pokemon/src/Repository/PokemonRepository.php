<?php
namespace Pokemon\Repository;

use Application\Repository\RepositoryInterface;
use Pokemon\Entity\Pokemon;
use Pokemon\Entity\Location;

interface PokemonRepository extends RepositoryInterface
{
    public function save(Pokemon $pokemon);

    public function getAll();
    /**
     * @return Pokemon|null
    **/
    public function findById($pokemonId);

    public function update($id, $data);

    public function delete($pokemonId);

    public function marked();

    public function signal(Location $location);

    public function dispo($idNational);
}
