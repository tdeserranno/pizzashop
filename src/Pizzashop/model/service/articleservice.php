<?php

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
        if (isset($id) && !empty($id)){
            $result = ArticleDAO::getById($id);
             return $result;
        } else {
            throw new \Exception('attempting to run showArticlelist(id) with empty id');
        }
    }
    
    public static function showArticlelistByCategory($category)
    {
        if (isset($category) && !empty($category)) {
            $result = ArticleDAO::getByCategory($category);
            return $result;
        } else {
            throw new \Exception('attempting to run showArticlelistByCategory('.$category.')');
        }
    }
    
    public static function update($post)
    {
        if (isset($post['id']) && !empty($post['id'])) {
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
        if (isset($id) && !empty($id)) {
            ArticleDAO::delete($id);
        }
    }
}
