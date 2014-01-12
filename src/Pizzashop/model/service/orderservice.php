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
                $shoppingcart->getCustomer()->getId(),
                $shoppingcart->getShop()->getId());
        foreach ($shoppingcart->getItems() as $item) {
            // for each line insert orderline
            OrderlineService::create($orderid, $item);
        }
    }
    
    public static function showOrderlist()
    {
        $result = OrderDAO::getAll();
        return $result;
    }
    
    public static function updateOrderstatus($post)
    {
        if (isset($post)) {
            foreach ($post['order'] as $key => $line) {
                OrderDAO::updateStatus($post['order'][$key], $post['orderstatus'][$key]);
            }
        }
    }
}
