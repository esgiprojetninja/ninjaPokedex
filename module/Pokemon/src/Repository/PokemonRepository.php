<?php
namespace Pokemon\Repository;

use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Pokedex\Entity\Pokemon;
use Pokedex\Entity\Type;
class PokemonRepository extends EntityRepository {
    public function findLike( $name )
    {
        $query = $this->_em->createQueryBuilder();
        // Reminder : don't look for sql columns but entity's properties
        $query->select('p')
            ->from('Pokemon\Entity\Pokemon', 'p')
            ->where("p.name LIKE '%" . $name . "%'");
        return $query->getQuery()->getResult();
    }
    public function findLikeAndType( $name, $typeId )
    {
        $query = $this->_em->createQueryBuilder();
        // Reminder : don't look for sql columns but entity's properties
        $query->select('p')
            ->from('Pokemon\Entity\Pokemon', 'p')
            ->innerJoin('p.types', 't')
            ->where("p.name LIKE '%" . $name . "%'")
            ->andWhere('t.id = ' . $typeId)
        ;
        return $query->getQuery()->getResult();
    }
}
