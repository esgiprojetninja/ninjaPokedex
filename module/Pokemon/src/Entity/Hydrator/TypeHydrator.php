<?php
namespace Pokemon\Entity\Hydrator;

use Pokemon\Entity\Type;
use Zend\Hydrator\HydratorInterface;

class TypeHydrator implements HydratorInterface {
    public function extract($object) {
        if (!$object instanceof Type)
            return [];

        return [
            'id_type'   => $object->getIdType(),
            'name_type' => $object->getNameType(),
            'color'     => $object->getColor()
        ];
    }
    public function hydrate(array $data, $object) {
        if (!$object instanceof Type)
          return $object;

        $object->setIdType(isset($data['id_type']) ? intval($data['id_type']) : null);
        $object->setNameType(isset($data['name_type']) ? $data['name_type'] : null);
        $object->setColor(isset($data['color']) ? $data['color'] : null);
        return $object;
    }
}
