<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Deliveryzone;

/**
 * Description of deliveryzonedao
 *
 * @author cyber02
 */
class DeliveryzoneDAO
{
    public static function getByShopid($shopid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM deliveryzones WHERE shopid = :shopid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':shopid' => $shopid))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create article object
                    $deliveryzone = new Deliveryzone($shopid,
                            $record['postcode'],
                            $record['delivery_cost']);
                    array_push($result, $deliveryzone);
                }
                return $result;
            } else {
                throw new \Exception('deliveryzone getbyshopid recordset empty');
            }
        } else {
            throw new \Exception('deliveryzone getbyshopid statement could not be executed');
        }
    }
}
