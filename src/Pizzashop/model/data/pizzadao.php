<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Pizza;

/**
 * Description of pizzadao
 *
 * @author cyber02
 */
class PizzaDAO
{
    public static function getById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM articles WHERE category = :categoryname and id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':categoryname' => 'pizza',':id' => $id))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                //test if article is a pizza and if so create pizza object????
                $toppings = 
                $pizza = new Pizza(
                            $record['id'],
                            $record['name'],
                            $record['description'],
                            $record['image'],
                            $record['price'],
                            $record['promo_status'],
                            $record['category'],
                            $toppings
                            );
                return $article;
            } else {
                throw new \Exception('article getbyid recordset empty');
            }
        } else {
            throw new \Exception('article getbyid statement could not be executed');
        }

    }
}
