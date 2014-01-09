<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\CategoryDAO;

/**
 * Description of categoryservice
 *
 * @author cyber02
 */
class CategoryService
{
    public static function getCategories()
    {
        $result = CategoryDAO::getAll();
        return $result;
    }
    
    public static function getCategory($categoryname)
    {
        $result = CategoryDAO::getByName($categoryname);
        return $result;
    }
}
