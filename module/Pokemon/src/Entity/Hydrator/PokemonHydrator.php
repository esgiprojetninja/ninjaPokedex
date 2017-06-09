<?php

namespace Pokemon\Entity\Hydrator;

use Pokemon\Entity\Pokemon;
use Zend\Hydrator\HydratorInterface;

class PokemonHydrator implements HydratorInterface{
    public function extract($object) {
      if ( !($object instanceof Pokemon))
          return [];

                      echo " TEST extract ";

      return [
          'id_pokemon'    => $object->getIdPokemon(),
          'name'          => $object->getName(),
          'description'   => $object->getDescription(),
          'localisation'  => $object->getLocalisation(),
          'id_parent'     => $object->getIdParent(),
          'image'         => $object->getImage(),
          'id_national'   => $object->getIdNational()
      ];
    }

    public function hydrate(array $data, $object) {
        if ( !($object instanceof Pokemon) )
            return $object;

            echo " TEST hydrate ";

        $poke->setIdPokemon( isset($data['id_pokemon']) ? intval($data['id_pokemon']) : null );
        $poke->setName( isset($data['name']) ? $data['name'] : null );
        $poke->setDescription( isset($data['description']) ? $data['description'] : null );
        $poke->setLocalisation( isset($data['localisation']) ? intval($data['localisation')] : null );
        $poke->setIdParent( isset($data['id_parent']) ? intval($data['id_parent')] : null );
        $poke->setImage( isset($data['image']) ? intval($data['image']) : null );
        $poke->setIdNational( isset($data['id_national']) ? intval($data['id_national']) : null );

        return $poke;
    }
}
