<?php
namespace Pokemon\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class PokemonsController extends AbstractRestfulController {

    protected $pokemonService;

    public function __construct($pokemonService) {
        $this->pokemonService = $pokemonService;
    }

    public function signalAction() {
        var_dump("signal Action !! isPost: ", $this->request->isPost());
        var_dump("signal Action !! getPost: ", $this->request->getPost());
        exit;
    }

    public function get($id) {
        return new JsonModel(
              $this->pokemonService->findById($id)
        );
    }
    public function getList() {
        return new JsonModel(
            $this->pokemonService->getAll()
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
        try {
            $this->pokemonService->delete($id);
            $message = 'success';
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return new JsonModel([$message]);
    }
    public function methodNotAllowed() {
        $this->response->setStatusCode(
            \Zend\Http\PhpEnvironment\Response::STATUS_CODE_405
        );
        throw new Exception('Method Not Allowed');
    }
}
