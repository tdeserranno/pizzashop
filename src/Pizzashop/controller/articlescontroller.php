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
    
    public function viewAll()
    {
        $this->model = ArticlesService::showArticlelist();
        $this->view = $this->app->environment->render('articlelist.twig', array('articles' => $this->model['articles']));
        print($this->view);
    }
    
    public function viewDetail($arguments)
    {
        $this->model = ArticlesService::showArticle($arguments);
        $this->view = $this->app->environment->render('articledetail.twig', array('article' => $this->model['article']));
        print($this->view);
    }
    
    public function viewCategory($arguments)
    {
        $this->model = ArticlesService::showArticlelist($arguments);
        $this->view = $this->app->environment->render('articlelist.twig', array('articles' => $this->model['articles']));
        print($this->view);
    }
    
    public function add()
    {
        //add new article
    }
    
    public function save()
    {
        //update existing article
        ArticlesService::update($_POST);
        //redirect to articlelist
        header('Location: /pizzashop/articles/viewall');
        exit();
    }
}