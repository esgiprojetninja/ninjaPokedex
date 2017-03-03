<?php

namespace Blog\Controller;

use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Form\Add;
use Blog\InputFilter\AddPost;
use Blog\Entity\Post;

class IndexController extends AbstractActionController {

    protected $blogService;

    public function __construct($blogService) {
        $this->blogService = $blogService;
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
            $blogPost = new Post();
            $form->bind($blogPost);
            $form->setInputFilter(new AddPost());

            $data = $this->request->getPost(); //key value array
            $form->setData($data);

            if ($form->isValid()) {
                $this->blogService->save($blogPost);
                return $this->redirect()->toRoute('blog_home');
            }

        }

        return new ViewModel($variables);
    }

}
