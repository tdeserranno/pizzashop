<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\ArticleDAO;

/**
 * Description of articlesservice
 *
 * @author cyber02
 */
class ArticlesService
{
    public static function showArticlelist($arguments)
    {
        $category = $arguments[0];
        $result = array();
        if ($category == 'all') {
            $articles = ArticleDAO::getAll();
        } else {
            $articles = ArticleDAO::getByCategory($category);
        }
        $result['articles'] = $articles;
        return $result;
    }
}
