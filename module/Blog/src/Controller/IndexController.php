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
            'name' => "quoimaggle"
        ];
        //@todo fetch blog pg_connection_status
        return new ViewModel($variables);
    }
    public function addAction () {
        $form = new Add("fdp");
        $variables = [
            'form' => $form
        ];
        return new ViewModel($variables);
    }
}
