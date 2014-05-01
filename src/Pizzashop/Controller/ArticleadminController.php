<?php

namespace Pizzashop\Controller;

use Framework\AbstractController;
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
class ArticleAdminController extends AbstractController
{

    function __construct($app)
    {
        parent::__construct($app);
    }

    public function viewAll()
    {
        $articles = ArticleService::showArticlelist();
        $this->render('articleadminlist.twig', array(
            'articles' => $articles,
        ));
    }

    public function viewDetail($arguments)
    {
        //assign arguments
        $id = $arguments[0];

        //build model
        $categories = CategoryService::getCategories();
        $article = ArticleService::showArticle($id);
        
        //check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['articleform'])) {
            //handle form
            try {
                //update article
                ArticleService::update($_POST);
                //redirect to articlelist
                header('Location: ' . ROOT . '/articleadmin/viewall');
                exit();
            } catch (FormException $exc) {
                //render form with errors
                $this->render('articleadmindetail.twig', array(
                    'categories' => $categories,
                    'article' => $article,
                    'exception' => $exc,
                        ));
            }
        } else {
            //show empty articledetail form
            $this->render('articleadmindetail.twig', array(
                'article' => $article,
                'categories' => $categories,
            ));
        }
    }

    public function viewCategory($arguments)
    {
        $categoryId = $arguments[0];
        $articles = ArticleService::showArticlelist($categoryId);
        $this->render('articleadminlist.twig', array(
            'articles' => $articles,
        ));
    }

    public function add()
    {
        //build model
        $categories = CategoryService::getCategories();

        //check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['articleform'])) {
            //handle form
            try {
                //add new article
                ArticleService::create($_POST);
                //redirect to articlelist
                header('Location: ' . ROOT . '/articleadmin/viewall');
                exit();
            } catch (FormException $exc) {
                //render form with errors
                $this->render(
                        'articleadmindetail.twig', array(
                    'categories' => $categories,
                    'exception' => $exc,
                        )
                );
            }
        } else {
            //show empty articledetail form
            $this->render('articleadmindetail.twig', array(
                'categories' => $categories,
            ));
        }
    }

    /* One problem that needs to be addressed is to make it impossible for a
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
        header('Location: ' . ROOT . '/articleadmin/viewall');
        exit();
    }

}
