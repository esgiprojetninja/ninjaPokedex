<?php
namespace Pokemon\Controller;

use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\MvcEvent;
use Pokemon\Form\Connection as ConnectionForm;
use Pokemon\InputFilter\ConnectionPost;

class AdminController extends AbstractActionController {

    protected $pokemonService;
    protected $adminService;

    /**
     * We override the parent class' onDispatch() method to
     * set an alternative layout for all actions in this controller.
    */
    public function onDispatch(MvcEvent $e)
    {
        // Call the base class' onDispatch() first and grab the response
        $response = parent::onDispatch($e);

        // Set alternative layout
        $this->layout()->setTemplate('layout/layout_admin');

        // Return the response
        return $response;
    }

    public function __construct($pokemonService, $adminService) {
        $this->pokemonService = $pokemonService;
        $this->adminService = $adminService;
    }

    public function loginAction() {

    }

    public function addAdminAction() {
        $form = new ConnectionForm();
        if ( $this->getRequest()->isPost() ) {

        }
        return new ViewModel([
            'form' => $form
        ]);
    }

    public function indexAction() {
        $form = new ConnectionForm();
        if ( $this->getRequest()->isPost() ) {
            // var_dump($form);
            $form->setInputFilter(new ConnectionPost());
            $data = $this->request->getPost();
            $form->setData($data);
            var_dump($data);
            if ($form->isValid()) {
                var_dump("it's all good brother !");
                // $this->pokemonService->save($connectionPost);
                // return $this->redirect()->toRoute('admin_home');
            } else {
                var_dump("fucking form is invalid dude");
            }
        }
        return new ViewModel([
            'form' => $form
        ]);
    }
}
