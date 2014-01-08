<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\ArticleDAO;
use Pizzashop\Model\Entity\Article;

/**
 * Description of articlesservice
 *
 * @author cyber02
 */
class ArticlesService
{
    public static function showArticlelist()
    {
        $result = array();
        $articles = ArticleDAO::getAll();
        $result['articles'] = $articles;
        return $result;
    }
    
    public static function showArticle($arguments)
    {
        $id = $arguments[0];
        $result = array();
        $article = ArticleDAO::getById($id);
        $result['article'] = $article;
        return $result;
    }
    
    public static function showArticlelistByCategory($arguments)
    {
        $category = $arguments[0];
        $articles = ArticleDAO::getByCategory($category);
        $result['articles'] = $articles;
        return $result;
    }
    
    public static function update($post)
    {
        if (isset($_POST['id'])) {
            ArticleDAO::update($post);
        }
    }
}
