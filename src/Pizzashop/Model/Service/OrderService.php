<?php

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
        if (isset($shoppingcart) && is_object($shoppingcart)) {
            // insert order
            $orderid = OrderDAO::create(
                    $shoppingcart->getDeliverytype(),
                    1,//orderstatus
                    $shoppingcart->getCustomer()->getId(),
                    $shoppingcart->getShop()->getId()
                    );
            foreach ($shoppingcart->getItems() as $item) {
                // for each line insert orderline
                OrderlineService::create($orderid, $item);
            }
        }
    }
    
    public static function showOrderlist()
    {
        $result = OrderDAO::getAll();
        return $result;
    }
    
    public static function showOrdersByCustomer($customerid)
    {
        if (isset($customerid) && !empty($customerid)) {
            $result = OrderDAO::getByCustomer($customerid);
            return $result;
        } else {
            throw new \Exception('attempting to run showOrdersByCustomer(id) with empty id');
        }
    }
    
    public static function updateOrderstatus($post)
    {
        if (isset($post['order'], $post['orderstatus'])) {
            foreach ($post['order'] as $key => $line) {
                OrderDAO::updateStatus($post['order'][$key], $post['orderstatus'][$key]);
            }
        }
    }
    
    public static function showOpenOrders()
    {
        $result = OrderDAO::getUndelivered();
        return $result;
    }
    
    public static function showOpenOrdersTotal()
    {
        $result = OrderDAO::getUndeliveredTotal();
        return $result;
    }
    
    public static function showOpenOrdersCustomerTotals()
    {
        $result = OrderDAO::getUndeliveredCustomerTotals();
        return $result;
    }
}
