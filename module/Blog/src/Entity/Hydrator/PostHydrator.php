<?php

namespace Blog\Entity\Hydrator;

use Blog\Entity\Post;
use Blog\Entity\Category;
use Zend\Hydrator\HydratorInterface;

class CategoryHydrator implements HydratorInterface
{
    public function extract($object) {
      if ( !($object instanceof Post) || $object->getName() == null )
          return [];

      return [
          'id'        => $object->getId(),
          'name'     => $object->getName(),
          'slug'      => $object->getSlug()
      ];
    }

    public function hydrate(array $data, $object) {
        if ( !($object instanceof Post) )
            return $object;

        $category = new Category();

        $category->setId( isset($data['id']) ? intval($data['id']) : null );
        $category->setName( isset($data['name']) ? $data['name'] : null );
        $category->setSlug( isset($data['slug']) ? $data['slug'] : null );

        return $category;
    }
}
