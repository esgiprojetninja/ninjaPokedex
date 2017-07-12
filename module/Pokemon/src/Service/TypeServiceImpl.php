<?php
/**
 * Interaction DB
 * C'est ici qu'on vient foutre nos requêtes
 *
**/
namespace Pokemon\Service;

use Pokemon\Service\TypeService;
use Pokemon\Entity\Type;

class TypeServiceImpl implements TypeService
{
    protected $typeRepository;

    function getTypeRepository() {
        return $this->typeRepository;
    }
    function setTypeRepository($typeRepository) {
        $this->typeRepository = $typeRepository;
    }
    function getAllTypes() {
        return $this->typeRepository->getAllTypes();
    }
    function getPokemonTypes($idPoke) {
        return $this->typeRepository->getPokemonTypes($idPoke);
    }
}
