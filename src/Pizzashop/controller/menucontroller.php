<?php

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\ArticleService;
use Pizzashop\Model\Service\ToppingService;

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

    public function showToppings()
    {
        $this->model['toppings'] = ToppingService::showToppinglist();
        $this->view = $this->app->environment->render('menutoppings.twig', array('toppings' => $this->model['toppings']));
        print($this->view);
    }
    
    public function show($arguments)
    {
        $category = $arguments[0];
        $this->model['articles'] = ArticleService::showArticlelistByCategory($category);
        $this->view = $this->app->environment->render('menu.twig', array('articles' => $this->model['articles']));
        print($this->view);
    }
}
