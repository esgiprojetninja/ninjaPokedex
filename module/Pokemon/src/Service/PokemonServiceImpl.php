<?php
/**
 * Interaction DB
 * C'est ici qu'on vient foutre nos requêtes
 *
**/
namespace Pokemon\Service;

use Pokemon\Service\PokemonService;
use Pokemon\Entity\Pokemon;
use Pokemon\Entity\Location;

class PokemonServiceImpl implements PokemonService
{
    protected $pokemonRepository;

    function getPokemonRepository() {
        return $this->pokemonRepository;
    }
    function setPokemonRepository($pokemonRepository) {
        $this->pokemonRepository = $pokemonRepository;
    }

    function save(Pokemon $pokemon) {
        return $this->pokemonRepository->save($pokemon);
    }
    function getAll() {
        return $this->pokemonRepository->getAll();
    }
    function getAllTypes() {
        return $this->pokemonRepository->getAllTypes();
    }
    /**
     * @return Pokemon|null
    **/
    function findById($pokeId) {
        return $this->pokemonRepository->findById($pokeId);
    }
    function update($id, $data){
        return $this->pokemonRepository->update($id, $data);
    }
    function delete($pokeId) {
        return $this->pokemonRepository->delete($pokeId);
    }
    function marked() {
        return $this->pokemonRepository->marked();
    }
    function signal(Location $location) {
        return $this->pokemonRepository->signal($location);
    }
}
