<?php

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
        if (isset($categoryname) && !empty($categoryname)) {
            $result = CategoryDAO::getByName($categoryname);
            return $result;
        } else {
            throw new \Exception('attempting to run getCategory(categoryname) with empty name');
        }
    }
}
