<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Service\ToppingService;

/**
 * Description of orderlinetoppingdao
 *
 * @author Thomas
 */
class OrderlineToppingDAO
{
    public static function create($orderlineid, $toppingid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO orderlines_toppings';
        $sql .= ' (orderlineid, toppingid)';
        $sql .= ' VALUES (:orderlineid, :toppingid)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':orderlineid' => $orderlineid,
                                ':toppingid' => $toppingid))) {
                //orderlinetopping is inserted
        } else {
            throw new \Exception('orderlines_toppings insert statement could not be executed');
        }
    }
    
    public static function getToppingsByOrderline($orderlineid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM orderlines_toppings WHERE orderlineid = :orderlineid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':orderlineid' => $orderlineid))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
//            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    $topping = ToppingService::showTopping($record['toppingid']);
                    array_push($result, $topping);
                }
                return $result;
//            } else {
//                throw new \Exception('orderlines_toppings getbyid recordset empty');
//            }
        } else {
            throw new \Exception('orderlines_toppings getbyid statement could not be executed');
        }
    }
}
