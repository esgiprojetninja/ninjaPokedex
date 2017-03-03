<?php

namespace Blog\Controller;

use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Form\Add;
use Blog\InputFilter\AddPost;

class IndexController extends AbstractActionController {

    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function indexAction () {
        $variables = [

        ];

        //@todo fetch blog pg_connection_status
        return new ViewModel($variables);
    }

    public function addAction () {
        $form = new Add();

        $variables = [
            'form' => $form
        ];

        if ($this->request->isPost()) { //Si le form a été submit
            $form->setInputFilter(new AddPost());

            $data = $this->request->getPost(); //key value array
            $form->setData($data);

            if ($form->isValid()) {
                // @todo insert into db
                return $this->redirect()->toRoute('blog_home');
            }

        }

        return new ViewModel($variables);
    }

}
