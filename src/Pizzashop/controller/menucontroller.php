<?php

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\ArticleService;

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

    public function showAll()
    {
        $this->model = ArticleService::showArticlelist();
        $this->view = $this->app->environment->render('menu.twig', array('articles' => $this->model['articles']));
        print($this->view);
    }
    
    public function show($arguments)
    {
        $this->model = ArticleService::showArticlelistByCategory($arguments);
        $this->view = $this->app->environment->render('menu.twig', array('articles' => $this->model['articles']));
        print($this->view);
    }
}
