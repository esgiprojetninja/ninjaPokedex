<?php

namespace Pokemon\Entity\Hydrator;

use Pokemon\Entity\Pokemon;
use Zend\Hydrator\HydratorInterface;

class PokemonHydrator implements HydratorInterface{
    function extract($poke) {
      if ( !($poke instanceof Pokemon) )
          return [];

      return [
          'id'        => $poke->getId(),
          'name'      => $poke->getName(),
          'type'      => $poke->getType(),
          'health'    => $poke->getHealth(),
          'number'    => $poke->getNumber(),
          'parent'    => $poke->getParent(),
          'attacks'   => $poke->getAttacks()
      ];
    }

    function hydrate(array $data, $poke) {
        if ( !($poke instanceof Pokemon) )
            return $poke;

        $poke->setId( isset($data['id']) ? intval($data['id']) : null );
        $poke->setName( isset($data['name']) ? $data['name'] : null );
        $poke->setType( isset($data['type']) ? $data['type'] : null );
        $poke->setHealth( isset($data['health']) ? intval($data['health')] : null );
        $poke->setNumber( isset($data['number']) ? intval($data['number')] : null );
        $poke->setParent( isset($data['parent']) ? intval($data['parent']) : null );
        $poke->setAttacks( isset($data['attacks']) ? intval($data['attacks']) : null );

        return $poke;
    }
}
