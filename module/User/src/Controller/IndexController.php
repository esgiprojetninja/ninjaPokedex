<?php
namespace User\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use User\Form\Add;
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
}
