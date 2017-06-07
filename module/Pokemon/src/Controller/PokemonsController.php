<?php
namespace Pokemon\Controller;

use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Debug\Debug;
use Pokemon\Entity\Pokemon;

class PokemonsController extends AbstractRestfulController {

    /**
    * Entity manager.
    * @var Doctrine\ORM\EntityManager
    */
    private $entityManager;

    public function __construct($entityManager) {
        var_dump($entityManager);
        exit;
        $this->entityManager = $entityManager;
    }

    public function signalAction() {
        var_dump("signal Action !! isPost: ", $this->request->isPost());
        var_dump("signal Action !! getPost: ", $this->request->getPost());
        exit;
    }

    public function get($id) {
        return new JsonModel(
            array("get" => $id)
        );
    }
    public function getList() {
        $pokemons = $this->entityManager->getRepository(Pokemon::class)
            ->findAll();
        return new JsonModel(
            array('pokemons' => $pokemons)
        );
    }
    public function create($data) {
        return new JsonModel(
            array("create" => $data)
        );
    }
    public function update($id, $data) {
        return new JsonModel(
            array("update" => $id)
        );
    }
    public function delete($id) {
        return new JsonModel(
            array("delete" => $id)
        );
    }
    public function methodNotAllowed() {
        $this->response->setStatusCode(
            \Zend\Http\PhpEnvironment\Response::STATUS_CODE_405
        );
        throw new Exception('Method Not Allowed');
    }
}
