<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Orderline;
use Pizzashop\Model\Service\ArticleService;
use Pizzashop\Model\Service\OrderlineToppingService;

/**
 * Description of orderlinedao
 *
 * @author Thomas
 */
class OrderlineDAO
{
    public static function create($orderid, $articleid, $quantity, $price)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO orderlines';
        $sql .= ' (orderid, articleid, quantity, price)';
        $sql .= ' VALUES (:orderid, :articleid, :quantity, :price)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':orderid' => $orderid,
                                ':articleid' => $articleid,
                                ':quantity' => $quantity,
                                ':price' => $price))) {
            //orderline is inserted
            return $db->lastInsertId();
        } else {
            throw new \Exception('orderline insert statement could not be executed');
        }
    }
    
    public static function getByOrder($orderid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM orderlines WHERE orderid = :orderid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':orderid' => $orderid))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                        //create article object
                        $article = ArticleService::showArticle($record['articleid']);
                        //create toppings objects
                        $toppings = OrderlineToppingService::getByOrderline($record['id']);
                        //create orderline object
                        $orderline = new Orderline(
                                $article,
                                $record['quantity'],
                                $record['price'],
                                $toppings);
                        array_push($result, $orderline);
                }
                return $result;
            } else {
                throw new \Exception('orderline getall recordset empty');
            }
        } else {
            throw new \Exception('orderline getall statement could not be executed');
        }
    }
}
