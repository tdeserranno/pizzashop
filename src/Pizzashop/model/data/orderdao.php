<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Order;

/**
 * Description of orderdao
 *
 * @author Thomas
 */
class OrderDAO
{
    public static function create($date, $delivery_type, $orderstatusid, $customerid, $shopid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO orders';
        $sql .= ' (date, delivery_type, status, customerid, shopid)';
        $sql .= ' VALUES (CURDATE(), :delivery_type, :status, :customerid, :shopid)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':date' => $date,
                                ':delivery_type' => $delivery_type,
                                ':status' => $status,
                                ':customerid' => $customerid,
                                ':shopid' => $shopid))) {
            //order is inserted
            return $db->lastInsertId();
        } else {
            throw new \Exception('order insert statement could not be executed');
        }
    }
}
