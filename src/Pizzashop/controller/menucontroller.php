<?php

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\ArticlesService;

/**
 * Description of menucontroller
 *
 * @author cyber02
 */
class MenuController extends Controller
{
    function __construct($app)
    {
        parent::__construct($app);
    }

    public function show($arguments)
    {
        $this->model = ArticlesService::showArticlelist();
        $this->view = $this->app->environment->render('menu.twig', array('articles' => $this->model['articles']));
        print($this->view);
    }
}
