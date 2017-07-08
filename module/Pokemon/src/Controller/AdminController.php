<?php
namespace Pokemon\Controller;

use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\MvcEvent;
use Pokemon\Entity\Admin;
use Pokemon\Entity\Pokemon;
use Pokemon\Entity\Hydrator\PokemonHydrator;
use Pokemon\Form\Connection as ConnectionForm;
use Pokemon\InputFilter\ConnectionPost;
use Pokemon\Form\AddAdmin as AddAdminForm;
use Pokemon\InputFilter\AddAdminPost;
use Pokemon\Form\Pokemon as PokemonForm;
use Pokemon\InputFilter\UpdatePokemonPost;

class AdminController extends AbstractActionController {

    protected $pokemonService;
    protected $adminService;
    protected $updatePokemonFilter;
    protected $pokeHydrator;
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

    public function __construct($pokemonService, $adminService, \Pokemon\InputFilter\UpdatePokemonPost $updatePokemonFilter) {
        $this->pokemonService = $pokemonService;
        $this->adminService = $adminService;
        $this->updatePokemonFilter = $updatePokemonFilter;
        $this->identity = $adminService->getAuthenticationService()->getIdentity();
        $this->pokeHydrator = new PokemonHydrator();
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
                if ( true === $loginResult ) {
                    $url = $this->getRequest()->getHeader('Referer')->getUri();
                    return $this->redirect()->toUrl($url);
                }
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
            'pokemons' => $this->pokemonService->getAll(),
            'messages' => $this->flashMessenger()->getMessages()
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

    public function updatePokemonAction() {
        $form = new PokemonForm($this->pokemonService);
        if ( $this->identity == null )
            return $this->redirect()->toRoute('admin_home/admin_login');

        if ( $this->request->isPost() ) {
            $pokemon = new Pokemon();
            $form->bind($pokemon);
            $form->setInputFilter($this->updatePokemonFilter);

            $data = array_merge_recursive(
                $this->request->getPost()->toArray(),
                $this->params()->fromFiles()
            );
            $form->setData($data);
            var_dump($data);
            if ($form->isValid()) {
                $data = $form->getData();
                var_dump("form detected valid", $data);
                // $this->blogService->update($pokemon);
                // return $this->redirect()->toRoute('blog_home');
            }
        }
        $pokemon = $this->pokemonService->findById((int) $this->params()->fromRoute('id'));

        $pokemon = ($pokemon != null) ? $this->pokeHydrator->hydrate($pokemon, new Pokemon()) : null;
        //PokemonHydrator
        return new ViewModel([
            'form' => $form,
            'pokemon' => $pokemon,
            'messages' => array_merge_recursive(
                $this->flashMessenger()->getMessages(),
                $form->getMessages()
            )
        ]);
    }

    public function deletePokemonAction() {
        if ( $this->identity == null )
            return $this->redirect()->toRoute('admin_home/admin_login');

        $poke = $this->pokemonService->findById((int) $this->params()->fromRoute('id'));
        if ( $poke != null )
            $this->flashMessenger()->addMessage('Pokemon deleted !');
        else
            $this->flashMessenger()->addMessage('Could not find the pokemon to delete');

        return $this->redirect()->toRoute('admin_home');
    }
}