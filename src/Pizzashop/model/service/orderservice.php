<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\OrderDAO;
use Pizzashop\Model\Service\OrderlineService;

/**
 * Description of orderservice
 *
 * @author Thomas
 */
class OrderService
{
    public static function create($shoppingcart)
    {
        // insert order
        $orderid = OrderDAO::create($shoppingcart->getDeliverytype(),
                1,//orderstatus
                $shoppingcart->customer->getId(),
                $shoppingcart->shop->getId());
        foreach ($shoppingcart->items as $item) {
            // for each line insert orderline
            OrderlineService::create($orderid, $item);
        }
    }
}
