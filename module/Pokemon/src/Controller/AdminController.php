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

class AdminController extends AbstractActionController {

    protected $pokemonService;
    protected $adminService;
    protected $typeService;
    protected $updatePokemonFilter;
    protected $pokeHydrator;
    protected $identity;
    protected $imageManager;

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

    public function __construct($psc, $asc, $upf, $imm, $tsc, $cpf)
    {
        $this->pokemonService = $psc;
        $this->adminService = $asc;
        $this->typeService = $tsc;
        $this->updatePokemonFilter = $upf;
        $this->createPokemonFilter = $cpf;
        $this->imageManager = $imm;
        $this->identity = $asc->getAuthenticationService()->getIdentity();
        $this->pokeHydrator = new PokemonHydrator();
        $_SESSION['identity'] = ($this->identity != null) ? $this->identity->login : false;
    }

    public function addAdminAction()
    {
        $form = new AddAdminForm();

        if ( $this->getRequest()->isPost() ) {
            $admin = new Admin();
            $form->bind($admin);
            $form->setInputFilter(new AddAdminPost());
            $data = $this->request->getPost();
            $form->setData($data);
            if ( $form->isValid() ){
                $saveReturn = $this->adminService->add($admin);
                if ( true === $saveReturn )
                    return $this->redirect()->toRoute('admin_home/admin_login');
                else if ( false === $saveReturn )
                    $this->flashMessenger()->addMessage("Une erreur est suvenue à la création d'un admin");
                else
                    $this->flashMessenger()->addMessage($saveReturn);
            }
        }
        return new ViewModel([
            'form' => $form,
            'messages' => $this->flashMessenger()->getMessages()
        ]);
    }

    public function loginAction()
    {
        if ( $this->identity != null )
            return $this->redirect()->toRoute('admin_home');
        $form = new ConnectionForm();
        if ( $this->getRequest()->isPost() ){
            $form->setInputFilter(new ConnectionPost());
            $data = $this->request->getPost();
            $form->setData($data);
            if ( $form->isValid() ){
                $data = $form->getData();
                $loginResult = $this->adminService
                  ->login(
                    $data['login'],
                    $data['password']
                  );
                if ( true === $loginResult ){
                    $url = $this->getRequest()->getHeader('Referer')->getUri();
                    return $this->redirect()->toUrl($url);
                }
                else
                    $this->flashMessenger()->addMessage('Identifiants incorrects');
            } else
                $this->flashMessenger()->addMessage("Les champs n'ont pas été bien remplis !");
        }
        return new ViewModel([
            'form' => $form,
            'messages' => $this->flashMessenger()->getMessages()
        ]);
    }

    public function logoutAction()
    {
        $authenticationService = $this->adminService->getAuthenticationService();
        $authenticationService->clearIdentity();
        return $this->redirect()->toRoute('admin_home/admin_login');
    }

    public function indexAction()
    {
        if ( $this->identity == null )
            return $this->redirect()->toRoute('admin_home/admin_login');

        $page = intval($this->params()->fromRoute('page'));
        $pokemons = $this->pokemonService->getPaginated($page);

        foreach ($pokemons as $pokemon) {
            $pokemon = $this->pokemonService->hydrateWithRelatives($pokemon);
            $pokemon = $this->pokemonService->hydrateWithTypes($pokemon);
        }
        return new ViewModel([
            'pokemons' => $pokemons,
            'messages' => $this->flashMessenger()->getMessages()
        ]);
    }

    public function showPokemonAction()
    {
        if ( $this->identity == null )
            return $this->redirect()->toRoute('admin_home/admin_login');
        if ( !$this->getRequest()->isGet() ){
            $url = $this->getRequest()->getHeader('Referer')->getUri();
            return $this->redirect()->toUrl($url);
        }

        $pokemon = $this->pokemonService->findById((int) $this->params()->fromRoute('id'));

        if ( $pokemon != null ) {
            $pokemon = $this->pokeHydrator->hydrate($pokemon, new Pokemon());
            $pokemon = $this->pokemonService->hydrateWithRelatives($pokemon);
            $pokemon = $this->pokemonService->hydrateWithTypes($pokemon);
            $pokemon->setIdNational($this->pokemonService->formatNationalId($pokemon->getIdNational()));
        }

        return new ViewModel([
            'pokemon' => $pokemon
        ]);
    }

    public function updatePokemonAction()
    {
        if ( $this->identity == null )
            return $this->redirect()->toRoute('admin_home/admin_login');

        $viewed_pokemon = $this->pokemonService->findById((int) $this->params()->fromRoute('id'));
        $viewed_pokemon = ($viewed_pokemon != null) ? $this->pokeHydrator->hydrate($viewed_pokemon, new Pokemon()) : null;
        $form = new PokemonForm($this->pokemonService, $this->typeService, $viewed_pokemon);


        if ( $this->request->isPost() ){
            $data = array_merge_recursive(
                $this->request->getPost()->toArray(),
                $this->params()->fromFiles()
            );
            $matchedPokemon = $this->pokemonService->findById((string) (int) $data['id_pokemon']);
            if ( $matchedPokemon == null )
                return $this->redirect()->toRoute('admin_home');
            if ( (int) $matchedPokemon['id_national'] == (int) $data['id_national'] )
                unset($data['id_national']);

            if ( $viewed_pokemon->getName() == $data['name'] )
                unset($data['name']);

            $pokemon = new Pokemon();
            $form->bind($pokemon);
            $form->setInputFilter($this->updatePokemonFilter);
            $form->setData($data);
            if ( $form->isValid() ){
                // Move uploaded file to its destination directory.
                $form->getData();
                $data['image'] = $this->updatePokemonFilter->getRenamedFile();
                $id_poke = (int) $data['id_pokemon'];
                unset($data['submit']);
                unset($data['csrf']);
                if ( !isset($data['id_national']) )
                    $data['id_national'] = $matchedPokemon['id_national'];
                if ( false === $data['image'] )
                    $data['image'] = $this->imageManager->getDefaultWebHosting($data['id_national']);
                else {
                    $baseUrl = sprintf('%s://%s%s', $this->getEvent()->getRouter()->getRequestUri()->getScheme(), $this->getEvent()->getRouter()->getRequestUri()->getHost(), $this->getEvent()->getRequest()->getBaseUrl());
                    $data['image'] = $baseUrl . $this->imageManager->getPublicWebPath() . $data['image'];
                }
                if ( $this->pokemonService->update($id_poke, $data)){
                    $this->flashMessenger()->addMessage('Pokémon bien mis à jour');
                    return $this->redirect()->toRoute('admin_home');
                }
                else
                    $this->flashMessenger()->addMessage("Le Pokémon n'a pu être mis à jour !");
            }
        }

        return new ViewModel([
            'form' => $form,
            'pokemon' => $viewed_pokemon,
            'messages' => array_merge_recursive(
                $this->flashMessenger()->getMessages(),
                $form->getMessages()
            )
        ]);
    }

    public function deletePokemonAction()
    {
        if ( $this->identity == null )
            return $this->redirect()->toRoute('admin_home/admin_login');

        $poke = $this->pokemonService->findById((int) $this->params()->fromRoute('id'));
        if ( $poke != null ){
            if ( true === $this->pokemonService->delete($poke['id_pokemon']) )
                $this->flashMessenger()->addMessage('Pokémon supprimé');
            else
                $this->flashMessenger()->addMessage("Pokemon n'a pu être supprimé");
        }
        else
            $this->flashMessenger()->addMessage("Pokémon à supprimer introuvable");

        return $this->redirect()->toRoute('admin_home');
    }

    public function createPokemonAction()
    {
        if ( $this->identity == null )
            return $this->redirect()->toRoute('admin_home/admin_login');

        $form = new PokemonForm($this->pokemonService, $this->typeService);

        if ( $this->request->isPost() ){
            $data = array_merge_recursive(
                $this->request->getPost()->toArray(),
                $this->params()->fromFiles()
            );
            $pokemon = new Pokemon();
            $form->bind($pokemon);
            $form->setInputFilter($this->createPokemonFilter);
            $form->setData($data);
            if ( $form->isValid() ){
                $form->getData();
                $data['image'] = $this->createPokemonFilter->getRenamedFile();
                if ( false === $data['image'] )
                    $data['image'] = $this->imageManager->getDefaultWebHosting($data['id_national']);
                else {
                    $baseUrl = sprintf('%s://%s%s', $this->getEvent()->getRouter()->getRequestUri()->getScheme(), $this->getEvent()->getRouter()->getRequestUri()->getHost(), $this->getEvent()->getRequest()->getBaseUrl());
                    $data['image'] = $baseUrl . $this->imageManager->getPublicWebPath() . $data['image'];
                }
                $pokemon = $this->pokeHydrator->hydrate($data, new Pokemon());

                if ( true === $this->pokemonService->save($pokemon) ){
                    $this->flashMessenger()->addMessage('Le pokémon ' . $pokemon->getName() . ' a bien été créé');
                    return $this->redirect()->toRoute('admin_home');
                }
                else
                    $this->flashMessenger()->addMessage("Le pokémon n'a pu être créé");
            }
        }

        return new ViewModel([
            'form' => $form,
            'messages' => $this->flashMessenger()->getMessages()
        ]);
    }
}
