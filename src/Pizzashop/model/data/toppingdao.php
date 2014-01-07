<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Topping;

/**
 * Description of toppingdao
 *
 * @author cyber02
 */
class ToppingDao
{
    public static function getById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM toppings WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                //test if article is a pizza and if so create pizza object????
                $topping = new Topping(
                            $record['id'],
                            $record['name'],
                            $record['price']
                            );
                return $topping;
            } else {
                throw new \Exception('article getbyid recordset empty');
            }
        } else {
            throw new \Exception('article getbyid statement could not be executed');
        }

    }
}
