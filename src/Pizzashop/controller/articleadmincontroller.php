<?php

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\ArticleService;
use Pizzashop\Model\Service\CategoryService;

/**
 * Description of articleadmincontroller
 * 
 * Controller that handles the articles admin section of the app.
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
        $id = $arguments[0];
        $this->model['article'] = ArticleService::showArticle($id);
        $this->model['categories'] = CategoryService::getCategories();
        $this->view = $this->app->environment->render('articleadmindetail.twig', array('article' => $this->model['article'], 'categories' => $this->model['categories']));
        print($this->view);
    }
    
    public function viewCategory($arguments)
    {
        $category = $arguments[0];
        $this->model['articles'] = ArticleService::showArticlelist($category);
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
        $id = $arguments[0];
        ArticleService::delete($id);
        //redirect to articlelist
        header('Location: /pizzashop/articleadmin/viewall');
        exit();
    }
}