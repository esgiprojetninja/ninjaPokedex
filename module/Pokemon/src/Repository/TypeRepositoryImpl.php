<?php
namespace Pokemon\Repository;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Adapter\AdapterAwareTrait;

use Pokemon\Repository\TypeRepository;
use Pokemon\Entity\Type;
use Pokemon\Controller\TypesController;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

class TypeRepositoryImpl implements TypeRepository
{
    use AdapterAwareTrait;

    public function getAllTypes(){
        try {
            $sql = new \Zend\Db\Sql\Sql($this->adapter);
            $select = $sql->select();
            $select->from('type');

            $statement = $sql->prepareStatementForSqlObject($select);
            $r = $statement->execute();

            $resultSet = new ResultSet;
            $resultSet->initialize($r);

            $types = [];
            foreach ($resultSet as $type) {
              $types[] = $type;
            }

            return $types;
        } catch ( \Exception $e ) {
          return $e->getMessage();
        }
    }
}
