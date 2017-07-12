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

    public function getPokemonTypes($idPokemon) {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->from(['t' => 'type']);
        $select->join(
          ['p' => 'pokemon_has_type'],
          'p.id_type = t.id_type'
        );
        $select->where(array('id_pokemon' => $idPokemon));

        $statement = $sql->prepareStatementForSqlObject($select);
        $r = $statement->execute();

        $resultSet = new ResultSet;
        $resultSet->initialize($r);
        $types = [];
        $idType = 0;
        foreach ($resultSet as $type) {
          $idType++;
          $types['type'.$idType] = $type;
        }
        if($idType == 1){
          $types['type2'] = NULL;
        } else if ( $idType == 0 ) {
            $types['type1'] = NULL;
            $types['type2'] = NULL;
        }

        return $types;
    }
}
