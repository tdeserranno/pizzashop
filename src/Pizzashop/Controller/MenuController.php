<?php

namespace Pizzashop\Controller;
use Framework\AbstractController;
use Pizzashop\Model\Service\ArticleService;
use Pizzashop\Model\Service\ToppingService;

/**
 * Description of menucontroller
 *
 * @author cyber02
 */
class MenuController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }

    public function showToppings()
    {
        $toppings = ToppingService::showToppinglist();
        $this->render('menutoppings.twig', array(
            'toppings' => $toppings,
            ));
    }
    
    public function show($arguments)
    {
        $categoryId = $arguments[0];
        $articles = ArticleService::showArticlelistByCategory($categoryId);
        $this->render('menu.twig', array(
            'articles' => $articles,
            ));
    }
}
