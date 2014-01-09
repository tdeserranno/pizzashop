<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\ArticleService;
use Pizzashop\Model\Service\CategoryService;

/**
 * Description of articlescontroller
 *
 * @author cyber02
 */
class ArticleAdminController extends Controller
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function viewAll()
    {
        $this->model['articles'] = ArticleService::showArticlelist();
        $this->view = $this->app->environment->render('articleadminlist.twig', array('articles' => $this->model['articles']));
        print($this->view);
    }
    
    public function viewDetail($arguments)
    {
        $this->model['article'] = ArticleService::showArticle($arguments);
        $this->model['categories'] = CategoryService::getCategories();
        $this->view = $this->app->environment->render('articleadmindetail.twig', array('article' => $this->model['article'], 'categories' => $this->model['categories']));
        print($this->view);
    }
    
    public function viewCategory($arguments)
    {
        $this->model['articles'] = ArticleService::showArticlelist($arguments);
        $this->view = $this->app->environment->render('articleadminlist.twig', array('articles' => $this->model['articles']));
        print($this->view);
    }
    
    public function viewNew()
    {
        //show empty articledetail form
        $this->model['categories'] = CategoryService::getCategories();
        $this->view = $this->app->environment->render('articleadmindetail.twig', array('categories' => $this->model['categories']));
        print($this->view);
    }
    
    public function add()
    {
        //add new article
        ArticleService::create($_POST);
        //redirect to articlelist
        header('Location: /pizzashop/articleadmin/viewall');
        exit();
    }
    
    public function save()
    {
        //update existing article
        ArticleService::update($_POST);
        //redirect to articlelist
        header('Location: /pizzashop/articleadmin/viewall');
        exit();
    }
    
    public function delete($arguments)
    {
         //delete article
        ArticleService::delete($arguments);
        //redirect to articlelist
        header('Location: /pizzashop/articleadmin/viewall');
        exit();
    }
}