<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\ArticlesService;

/**
 * Description of articlescontroller
 *
 * @author cyber02
 */
class ArticlesController extends Controller
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function viewList($arguments)
    {
        $this->model = ArticlesService::showArticlelist($arguments);
        $this->view = $this->app->environment->render('articlelist.twig', array('articles' => $this->model['articles']));
        print($this->view);
    }
}
