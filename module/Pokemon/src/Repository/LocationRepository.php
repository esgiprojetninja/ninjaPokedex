<?php
namespace Pokemon\Repository;

use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Pokedex\Entity\Pokemon;

class LocationRepository extends EntityRepository {
    public function getLastPokemonLocation( Pokemon $pokemon ) {
        $query = $this->_em->createQueryBuilder();
        $now = new \DateTime();
        $period = new \DateTime();
        $period->sub(new \DateInterval("PT30M"));
        // Reminder : don't look for sql columns but entity's properties
        $query->select('l')
              ->from('Pokemon\Entity\Location', 'l')
              ->where('l.pokemon = :pokemonId')
              ->andWhere('l.createdAt BETWEEN :to AND :from')
              ->setParameter('pokemonId', $pokemon->getId())
              ->setParameter('from', $now->format('Y-m-d h:i:s'))
              ->setParameter('to', $period->format('Y-m-d h:i:s'))
        ;
        return $query->getQuery()->getResult();
    }
}
