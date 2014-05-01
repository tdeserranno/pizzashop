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
    
    public static function showTopping($id)
    {
        if (isset($id)) {
            $result = ToppingDAO::getById($id);
        return $result;
        } else {
            throw new \Exception('attempting to run getShop(id) with empty id');
        }
    }
    
    public static function update($post)
    {
        if (isset($post['id'])) {
            //assign and typecast variables
            $id = $post['id'];
            $name = $post['name'];
            $price = (float)$post['price'];

            //validate values
            if (ValidationService::validateTopping($name, $price)) {
                //create topping
                ToppingDAO::update($id, $name, $price);
            }
        }
    }
    
    public static function create($post)
    {
        //assign and typecast variables
        $name = $post['name'];
        $price = (float)$post['price'];
        
        //validate values
        if (ValidationService::validateTopping($name, $price)) {
            //create topping
            ToppingDAO::create($name, $price);
        }
    }
    
    public static function delete($id)
    {
        if (isset($id) && !empty($id)) {
            ToppingDAO::delete($id);
        }
    }    
}
