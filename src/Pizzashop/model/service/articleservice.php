<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\ArticleDAO;
use Pizzashop\Model\Service\CategoryService;

/**
 * Description of articleservice
 *
 * @author cyber02
 */
class ArticleService
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
        $categories = CategoryService::getCategories();
        $result['categories'] = $categories['categories'];
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
        if (isset($post['id'])) {
            ArticleDAO::update($post['id'],
                    $post['name'],
                    $post['description'],
                    $post['image'],
                    $post['price'],
                    $post['promo_status'],
                    $post['promo_price'],
                    $post['category']);
        }
    }
    
    public static function create($post)
    {
        if (isset($post)) {
            ArticleDAO::create($post['name'],
                    $post['description'],
                    $post['image'],
                    $post['price'],
                    $post['promo_status'],
                    $post['promo_price'],
                    $post['category']);
        }
    }
    
    public static function delete($arguments)
    {
        if (isset($arguments[0])) {
            $id = $arguments[0];
            ArticleDAO::delete($id);
        }
    }
}
