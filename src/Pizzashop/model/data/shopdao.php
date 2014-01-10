<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Shop;
use Pizzashop\Model\Service\DeliveryzoneService;

/**
 * Description of shopdao
 *
 * @author cyber02
 */
class ShopDAO
{
    public static function getById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM shops WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                //create deliveryzone objects
                $deliveryzones = DeliveryzoneService::getShopDeliveryzones($id);
                //create shop object
                $shop = new Shop($id,
                        $record['address'],
                        $record['postcode'],
                        $record['city'],
                        $deliveryzones);
                return $shop;
            } else {
                throw new \Exception('shop getbyid recordset empty');
            }
        } else {
            throw new \Exception('shop getbyid statement could not be executed');
        }
    }
}
