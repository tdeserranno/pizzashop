<?php

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\ArticleService;
use Pizzashop\Model\Service\CategoryService;
use Pizzashop\Exception\FormException;

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
    
    public function add()
    {
        //build model
        $this->model['categories'] = CategoryService::getCategories();
        
        //check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['articleform'])) {
            //handle form
            try {
                //add new article
                ArticleService::create($_POST);
                //redirect to articlelist
                header('Location: /pizzashop/articleadmin/viewall');
                exit();
            } catch (FormException $exc) {
                //render form with errors
                $this->view = $this->app->environment->render(
                        'articleadmindetail.twig',
                        array(
                            'categories' => $this->model['categories'],
                            'exception' => $exc,
                            )
                        );
                print($this->view);
            }
        } else {
            //show empty articledetail form
            $this->view = $this->app->environment->render('articleadmindetail.twig', array('categories' => $this->model['categories']));
            print($this->view);
        }
        
    }
    
    public function save()
    {
        //update existing article
        ArticleService::update($_POST);
        //redirect to articlelist
        header('Location: /pizzashop/articleadmin/viewall');
        exit();
    }
    
    /**One problem that needs to be addressed is to make it impossible for a
     * delete method to run in any other way other than if it was started from
     * the correct page. Since we are supplying the id of the record to be
     * deleted in the URI someone could manually type in a different url with
     * a different id.
     * 
     * Solution: to be determined and implemented.
     * 
     * @param type $arguments
     */
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