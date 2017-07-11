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

    public function getPokemonRepository()
    {
        return $this->pokemonRepository;
    }
    public function setPokemonRepository($pokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function save(Pokemon $pokemon)
    {
        return $this->pokemonRepository->save($pokemon);
    }
    public function getAll()
    {
        return $this->pokemonRepository->getAll();
    }
    public function getAllTypes()
    {
        return $this->pokemonRepository->getAllTypes();
    }
    /**
     * @return Pokemon|null
    **/
    public function findById($pokeId)
    {
        return $this->pokemonRepository->findById($pokeId);
    }
    public function update($id, $data)
    {
        return $this->pokemonRepository->update($id, $data);
    }
    public function delete($pokeId)
    {
        return $this->pokemonRepository->delete($pokeId);
    }
    public function marked()
    {
        return $this->pokemonRepository->marked();
    }
    public function signal(Location $location)
    {
        return $this->pokemonRepository->signal($location);
    }
}
