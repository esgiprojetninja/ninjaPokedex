<?php

namespace Pokemon\Service;

use Pokemon\Entity\Pokemon;
use Pokemon\Entity\Location;

interface PokemonService
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
}
