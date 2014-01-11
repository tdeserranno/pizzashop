<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\OrderlineDAO;
use Pizzashop\Model\Service\OrderlineToppingService;

/**
 * Description of orderlineservice
 *
 * @author Thomas
 */
class OrderlineService
{
    public static function create($orderid, $shoppingcartItem)
    {
        //create orderline
        $orderlineid = OrderlineDAO::create($orderid,
                $shoppingcartItem->article->getId(),
                $shoppingcartItem->getQuantity(),
                $shoppingcartItem->article->getCost());
        //if there are toppings, for each topping insert orderlinetopping
        if (!empty($shoppingcartItem->extraToppings) && is_array($shoppingcartItem->extraToppings)) {
            foreach ($shoppingcartItem->extraToppings as $topping) {
                OrderlineToppingService::create($orderlineid, $topping);
            }
        }
    }
}
