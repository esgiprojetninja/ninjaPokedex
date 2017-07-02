<?php
namespace Pokemon\Controller;

use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\MvcEvent;
use Pokemon\Entity\Admin;
use Pokemon\Form\Connection as ConnectionForm;
use Pokemon\InputFilter\ConnectionPost;
use Pokemon\Form\AddAdmin as AddAdminForm;
use Pokemon\InputFilter\AddAdminPost;

class AdminController extends AbstractActionController {

    protected $pokemonService;
    protected $adminService;
    protected $identity;

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
        $this->identity = $adminService->getAuthenticationService()->getIdentity();
    }

    public function addAdminAction() {
        $form = new AddAdminForm();

        if ( $this->getRequest()->isPost() ) {
            $admin = new Admin();
            $form->bind($admin);
            $form->setInputFilter(new AddAdminPost());
            $data = $this->request->getPost();
            $form->setData($data);
            if ($form->isValid()) {
                $saveReturn = $this->adminService->add($admin);
                if ( true === $saveReturn )
                    return $this->redirect()->toRoute('admin_home/admin_login');
                else if ( false === $saveReturn )
                    $this->flashMessenger()->addMessage('An Error occurred while admin adding');
                else
                    $this->flashMessenger()->addMessage($saveReturn);
            }
        }
        return new ViewModel([
            'form' => $form,
            'messages' => $this->flashMessenger()->getMessages()
        ]);
    }

    public function loginAction() {
        if ( $this->identity != null )
            return $this->redirect()->toRoute('admin_home');
        $form = new ConnectionForm();
        if ( $this->getRequest()->isPost() ) {
            $form->setInputFilter(new ConnectionPost());
            $data = $this->request->getPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                $loginResult = $this->adminService
                  ->login(
                    $data['login'],
                    $data['password']
                  );
                if ( true === $loginResult )
                    return $this->redirect()->toRoute('admin_home');
                else
                    $this->flashMessenger()->addMessage('Invalid credentials');
            } else
                $this->flashMessenger()->addMessage('Invalid form received');
        }
        return new ViewModel([
            'form' => $form,
            'messages' => $this->flashMessenger()->getMessages()
        ]);
    }

    public function logoutAction() {
        $authenticationService = $this->adminService->getAuthenticationService();
        $authenticationService->clearIdentity();
        return $this->redirect()->toRoute('admin_home/admin_login');
    }

    public function indexAction() {
        if ( $this->identity == null )
            return $this->redirect()->toRoute('admin_home/admin_login');
        return new ViewModel([
            'pokemons' => $this->pokemonService->getAll()
        ]);
    }

    public function showPokemonAction() {
        if ( $this->identity == null )
            return $this->redirect()->toRoute('admin_home/admin_login');
        if ( !$this->getRequest()->isGet() ) {
            $url = $this->getRequest()->getHeader('Referer')->getUri();
            return $this->redirect()->toUrl($url);
        }
        return new ViewModel([
            'pokemon' => $this->pokemonService->findById((int) $this->params()->fromRoute('id'))
        ]);
    }
}
