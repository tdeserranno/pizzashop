<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\ArticleDAO;

/**
 * Description of articleservice
 *
 * @author cyber02
 */
class ArticleService
{
    public static function showArticlelist()
    {
        $result = ArticleDAO::getAll();
        return $result;
    }
    
    public static function showArticle($id)
    {
        if (isset($id)){
            $result = ArticleDAO::getById($id);
        }
        return $result;
    }
    
    public static function showArticlelistByCategory($category)
    {
        if (isset($category)) {
            $result = ArticleDAO::getByCategory($category);
        }
        return $result;
    }
    
    public static function update($post)
    {
        if (isset($post['id'])) {
            if (isset($post['promo_status']) && $post['promo_status'] == 'yes') {
                $promo = true;
            } else {
                $promo = false;
            }
            ArticleDAO::update($post['id'],
                    $post['name'],
                    $post['description'],
                    $post['image'],
                    $post['price'],
                    $promo,
                    $post['promo_price'],
                    $post['category']);
        }
    }
    
    public static function create($post)
    {
        if (isset($post)) {
            if (isset($post['promo_status']) && $post['promo_status'] == 'yes') {
                $promo = true;
            } else {
                $promo = false;
            }
            ArticleDAO::create($post['name'],
                    $post['description'],
                    $post['image'],
                    $post['price'],
                    $promo,
                    $post['promo_price'],
                    $post['category']);
        }
    }
    
    public static function delete($id)
    {
        if (isset($id)) {
            ArticleDAO::delete($id);
        }
    }
}
