<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Order;
use Pizzashop\Model\Service\OrderstatusService;
use Pizzashop\Model\Service\CustomerService;
use Pizzashop\Model\Service\ShopService;
use Pizzashop\Model\Service\OrderlineService;

/**
 * Description of orderdao
 *
 * @author Thomas
 */
class OrderDAO
{
    public static function create($delivery_type, $orderstatusid, $customerid, $shopid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO orders';
        $sql .= ' (date, delivery_type, status, customerid, shopid)';
        $sql .= ' VALUES (NOW(), :delivery_type, :status, :customerid, :shopid)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':delivery_type' => $delivery_type,
                                ':status' => $orderstatusid,
                                ':customerid' => $customerid,
                                ':shopid' => $shopid))) {
            //order is inserted
            return $db->lastInsertId();
        } else {
            throw new \Exception('order insert statement could not be executed');
        }
    }
    
    public static function getAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM orders';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create orderstatus object
                    $orderstatus = OrderstatusService::showOrderstatus($record['status']);
                    //create customer object
                    $customer = CustomerService::showCustomer($record['customerid']);
                    //create shop object
                    $shop = ShopService::getShop($record['shopid']);
                    //create orderlines object array
                    $orderlines = OrderlineService::showOrderlines($record['id']);
                    //create order object
                    $order = new Order(
                            $record['id'],
                            $record['date'],
                            $record['delivery_type'],
                            $orderstatus,
                            $customer,
                            $shop,
                            $orderlines);
                    array_push($result, $order);
                }
                return $result;
            } else {
                throw new \Exception('order getall recordset empty');
            }
        } else {
            throw new \Exception('order getall statement could not be executed');
        }
    }
    
    public static function getByCustomer($customerid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM orders WHERE customerid = :customerid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':customerid' => $customerid))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
//            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create orderstatus object
                    $orderstatus = OrderstatusService::showOrderstatus($record['status']);
                    //create customer object
                    $customer = CustomerService::showCustomer($record['customerid']);
                    //create shop object
                    $shop = ShopService::getShop($record['shopid']);
                    //create orderlines object array
                    $orderlines = OrderlineService::showOrderlines($record['id']);
                    //create order object
                    $order = new Order(
                            $record['id'],
                            $record['date'],
                            $record['delivery_type'],
                            $orderstatus,
                            $customer,
                            $shop,
                            $orderlines);
                    array_push($result, $order);
                }
                return $result;
//            } else {
//                throw new \Exception('order getbycustomer recordset empty');
//            }
        } else {
            throw new \Exception('order getbycustomer statement could not be executed');
        }
    }
    
    public static function updateStatus($id, $status)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE orders SET';
        $sql .= ' status = :status';
        $sql .= ' WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':status' => $status,
                                ':id' => $id))) {
            //orderstatus updated
        } else {
            throw new \Exception('order updatestatus statement could not be executed');
        }
    }
    
    public static function getUndelivered()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM orders WHERE delivery_type = \'deliver\' AND status IN '
                . '(SELECT id FROM orderstatus WHERE description NOT IN '
                . '(\'geleverd\',\'gesloten\'))';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
//            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create orderstatus object
                    $orderstatus = OrderstatusService::showOrderstatus($record['status']);
                    //create customer object
                    $customer = CustomerService::showCustomer($record['customerid']);
                    //create shop object
                    $shop = ShopService::getShop($record['shopid']);
                    //create orderlines object array
                    $orderlines = OrderlineService::showOrderlines($record['id']);
                    //create order object
                    $order = new Order(
                            $record['id'],
                            $record['date'],
                            $record['delivery_type'],
                            $orderstatus,
                            $customer,
                            $shop,
                            $orderlines);
                    array_push($result, $order);
                }
                return $result;
//            } else {
//                throw new \Exception('order getundelivered recordset empty');
//            }
        } else {
            throw new \Exception('order getundelivered statement could not be executed');
        }
    }
    
    public static function getUndeliveredTotal()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT SUM(price*quantity) AS total FROM orderlines WHERE orderid IN '
                . '(SELECT id FROM orders WHERE status IN '
                . '(SELECT id FROM orderstatus WHERE description NOT IN (\'geleverd\', \'gesloten\')) AND delivery_type = \'deliver\')';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $record = $stmt->fetch();
//            if (!empty($recordset)) {
                //return total
                return $record['total'];
//            } else {
//                throw new \Exception('order getundelivered recordset empty');
//            }
        } else {
            throw new \Exception('order getundeliveredtotal statement could not be executed');
        }
    }
    
    public static function getUndeliveredCustomerTotals()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT orders.customerid, SUM(price*quantity) AS total '
                . 'FROM orderlines,orders '
                . 'WHERE orderid IN '
                . '(SELECT id FROM orders WHERE  status IN '
                . '(SELECT id FROM orderstatus WHERE description NOT IN (\'geleverd\', \'gesloten\'))'
                . ' AND delivery_type = \'deliver\') '
                . 'AND orderlines.orderid = orders.id '
                . 'GROUP BY orders.customerid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
//            if (!empty($recordset)) {
                //return totals
                return $recordset;
//            } else {
//                throw new \Exception('order getundelivered recordset empty');
//            }
        } else {
            throw new \Exception('order getundeliveredcustomertotals statement could not be executed');
        }
    }
}
