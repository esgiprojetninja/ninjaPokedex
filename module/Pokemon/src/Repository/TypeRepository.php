<?php
namespace Pokemon\Repository;
use Application\Repository\RepositoryInterface;
use Pokemon\Entity\Type;

interface TypeRepository extends RepositoryInterface
{
    public function getAllTypes();
}
