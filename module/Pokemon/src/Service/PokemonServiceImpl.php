<?php
/**
 * Interaction DB
 * C'est ici qu'on vient foutre nos requêtes
 *
**/
namespace Pokemon\Service;

use Pokemon\Service\PokemonService;
use Pokemon\Entity\Pokemon;

class PokemonServiceImpl implements PokemonService
{
    protected $pokemonRepository;

    function getPokemonRepository() {
        return $this->pokemonRepository;
    }
    function setPokemonRepository($pokemonRepository) {
        $this->pokemonRepository = $pokemonRepository;
    }

    function save(Pokemon $post) {
        return $this->pokemonRepository->save($post);
    }
    function getAll() {
        return $this->pokemonRepository->getAll();
    }
    /**
     * @return Pokemon|null
    **/
    function findById($postId) {
        return $this->pokemonRepository->findById($postId);
    }
    function update(Pokemon $post) {
        return $this->pokemonRepository->update($post);
    }
    function delete($postId) {
        return $this->pokemonRepository->delete($postId);
    }
    function marked() {
        return $this->pokemonRepository->marked();
    }
}
