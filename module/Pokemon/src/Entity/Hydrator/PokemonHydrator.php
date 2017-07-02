<?php
namespace Pokemon\Entity\Hydrator;

use Pokemon\Entity\Pokemon;
use Zend\Hydrator\HydratorInterface;

class PokemonHydrator implements HydratorInterface {
    public function extract($object) {
        if (!$object instanceof Pokemon)
            return [];

        return [
            'id_pokemon'    => $object->getIdPokemon(),
            'name'          => $object->getName(),
            'description'   => $object->getDescription(),
            'id_parent'     => $object->getIdParent(),
            'image'         => $object->getImage(),
            'id_national'   => $object->getIdNational(),
            'type1'         => $object->getType1(),
            'type2'         => $object->getType2()
        ];
    }
    public function hydrate(array $data, $object) {
        if (!$object instanceof Pokemon)
          return $object;

        $object->setIdPokemon(isset($data['id_pokemon']) ? intval($data['id_pokemon']) : null);
        $object->setName(isset($data['name']) ? $data['name'] : null);
        $object->setDescription(isset($data['description']) ? $data['description'] : null);
        $object->setIdParent(isset($data['id_parent']) ? intval($data['id_parent']) : null);
        $object->setImage(isset($data['image']) ? $data['image'] : null);
        $object->setIdNational(isset($data['id_national']) ? intval($data['id_national']) : null);
        $object->setType1(isset($data['type1']) ? $data['type1'] : null);
        $object->setType2(isset($data['type2']) ? $data['type2'] : null);
        return $object;
    }
}
