<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\ToppingDAO;

/**
 * Description of toppingservice
 *
 * @author cyber02
 */
class ToppingService
{
    public static function showToppinglist()
    {
        $result = ToppingDAO::getAll();
        return $result;
    }
    
    public static function showTopping($arguments)
    {
        $result = array();
        if (isset($arguments[0])) {
            $id = $arguments[0];
            $result = ToppingDAO::getById($id);
        }
        return $result;
    }
    
    public static function update($post)
    {
        if (isset($post['id'])) {
            ToppingDAO::update($post['id'], $post['name'], $post['price']);
        }
    }
    
    public static function create($post)
    {
        if (isset($post)) {
            ToppingDAO::create($post['name'], $post['price']);
        }
    }
    
    public static function delete($arguments)
    {
        if (isset($arguments[0])) {
            $id = $arguments[0];
            ToppingDAO::delete($id);
        }
    }    
}
