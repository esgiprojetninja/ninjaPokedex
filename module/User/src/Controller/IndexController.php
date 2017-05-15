<?php
namespace User\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use User\Form\Add;
use User\Form\Login;
use User\Entity\User;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
    protected $addUserFilter;

    function __construct(\User\InputFilter\AddUser $addUserFilter) {
        $this->addUserFilter = $addUserFilter;
    }

    function addAction() {
        $form = new Add();
        $variables = [
          'form' => $form
        ];
        if ($this->request->isPost()) {
            $user = new User();
            $form->bind($user);
            $form->setInputFilter($this->addUserFilter);
            $form->setData($this->request->getPost());

            if ( $form->isValid() ) {
                // @TODO save user in db

            }
        }
        return new ViewModel($variables);
    }

    function loginAction() {
        if ( $this->identity() != null ) {
            return $this->redirect()->toRoute('blog_home');
        }

        $form = new Login();
        if ( $this->request->isPost() ) {
            //@TODO do login
        }

        return new ViewModel([
            'form' => $form;
        ]);
    }

    function logoutAction() {

    }
}
