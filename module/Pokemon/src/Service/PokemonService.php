<?php

namespace Pokemon\Service;

use Pokemon\Entity\Pokemon;

interface PokemonService
{
    public function save(Pokemon $pokemon);

    public function getAll();

    /**
     * @return Pokemon|null
    **/
    public function findById($pokemonId);

    public function update(Pokemon $pokemon);

    public function delete($pokemonId);
}
