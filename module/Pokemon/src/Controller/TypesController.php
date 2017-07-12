<?php
namespace Pokemon\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Pokemon\Entity\Type;

class TypesController extends AbstractRestfulController {

    protected $typeService;

    public function __construct($typeService) {
      $this->typeService = $typeService;
    }

    public function getList() {
      return new JsonModel(
        ['data'=>$this->typeService->getAllTypes()]
      );
    }
}
