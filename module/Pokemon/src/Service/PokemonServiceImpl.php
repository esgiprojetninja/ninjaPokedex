<?php
/**
 * Interaction DB
 * C'est ici qu'on vient foutre nos requêtes
 *
**/
namespace Pokemon\Service;

use Pokemon\Service\PokemonService;
use Pokemon\Entity\Pokemon;
use Pokemon\Entity\Hydrator\PokemonHydrator;
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
    /**
     * @return Pokemon|null
    **/
    public function findByIdNational($pokeId)
    {
        return $this->pokemonRepository->findByIdNational($pokeId);
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
    public function dispo($idNational) {
        return $this->pokemonRepository->dispo($idNational);
    }
    public function hydrateWithRelatives(Pokemon $pokemon)
    {
        return $this->pokemonRepository->hydrateWithRelatives($pokemon);
    }
    public function hydrateWithTypes(Pokemon $pokemon)
    {
        return $this->pokemonRepository->hydrateWithTypes($pokemon);
    }
    public function getPaginated($page)
    {
        return $this->pokemonRepository->getPaginated($page);
    }
    public function formatNationalId($national_id)
    {
        $national_id = (string) $national_id;
        while (strlen($national_id) < 3) {
            $national_id = "0".$national_id;
        }
        return '#'.$national_id;
    }
    public function canPokemonBeParentOf($idNationalParent, $idNationalChild)
    {
        $pokemonParent = $this->pokemonRepository->findByIdNational($idNationalParent);
        if ( $pokemonParent == null) return false;
        $pokemonChild = $this->pokemonRepository->findByIdNational($idNationalChild);
        if ( $pokemonChild == null) return false;

        $pokehydrator = new PokemonHydrator();
        $pokemonParent = $pokehydrator->hydrate($pokemonParent, new Pokemon());
        $pokemonParent = $this->pokemonRepository->hydrateWithRelatives($pokemonParent);
        $pokemonChild = $pokehydrator->hydrate($pokemonChild, new Pokemon());
        $pokemonChild = $this->pokemonRepository->hydrateWithRelatives($pokemonChild);

        if ( true === $this->isPokemonAFinalEvolution($pokemonParent) )
            return false;
        if ( false === $this->canPokemonHaveAParent($pokemonChild) )
            return false;

        $cumulatedTreeLen = $this->getPokemonTreeLength($pokemonChild) + $this->getPokemonTreeLength($pokemonParent);
        if ( $cumulatedTreeLen > 4)
            return false;

        // prevent Aquali -> evoli -> Aquali
        if ( $this->isFuturParentAlreadyAlsoAChild($pokemonParent, $pokemonChild) )
            return false;

        if ( $pokemonChild->getIdNational() == $pokemonParent->getIdNational() )
            return false;

        $parentPossibleEvolutions = $this->dispo($pokemonParent->getIdNational());
        return $parentPossibleEvolutions;
        foreach ($parentPossibleEvolutions as $parentPossibleEvolution) {
          if ( intval($parentPossibleEvolution->id_national) ==  intval($idNationalChild) )
            return true;
        }
        return false;
    }
    private function isFuturParentAlreadyAlsoAChild(Pokemon $parent_pokemon, Pokemon $child_pokemon)
    {
        if ( is_array($child_pokemon->getEvolutions()) && count($child_pokemon->getEvolutions()) > 0 ) {
            foreach($child_pokemon->getEvolutions() as $evo) {
                if ( intval($evo->getIdNational()) == intval($parent_pokemon->getIdNational()) )
                    return true;
            }
        }
        return false;
    }
    private function getPokemonTreeLength(Pokemon $pokemon)
    {
        $treeLen = 1;
        if ( $pokemon->getParent() != null ) {
          $treeLen += 1;
          if ( $pokemon->getParent()->getParent() != null )
            $treeLen += 1;
        }

        if ( is_array($pokemon->getEvolutions()) && count($pokemon->getEvolutions()) > 0 ) {
          $treeLen += 1;
          $found = false;
          foreach ($pokemon->getEvolutions() as $first_evolutions) {
            if ( is_array($first_evolutions->getEvolutions()) && count($first_evolutions->getEvolutions()) > 0 && !$found ) {
                $treeLen += 1;
                $found = true;
            }
          }
        }
        return $treeLen;
    }
    public function canPokemonHaveAParent(Pokemon $pokemon)
    {
        if ( is_array($pokemon->getEvolutions()) ) {
          foreach ($pokemon->getEvolutions() as $first_evolution) {
            if ( is_array($first_evolution->getEvolutions()) && count($first_evolution->getEvolutions()) > 0) {
                return false;
            }
          }
        }
        return true;
    }
    private function isPokemonAFinalEvolution(Pokemon $pokemon)
    {
      if ( $pokemon->getParent() != null ) {
        if ( $pokemon->getParent()->getParent() != null )
          return true;
      }
      return false;
    }
}
