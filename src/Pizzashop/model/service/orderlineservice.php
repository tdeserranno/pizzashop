<?php

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
        if (isset($orderid, $shoppingcartItem) && !empty($orderid) && is_object($shoppingcartItem)) {
            //create orderline
            $orderlineid = OrderlineDAO::create($orderid,
                    $shoppingcartItem->getArticle()->getId(),
                    $shoppingcartItem->getQuantity(),
                    $shoppingcartItem->getArticle()->getCost());
            //if there are toppings, for each topping insert orderlinetopping
            if (!empty($shoppingcartItem->getExtraToppings()) && is_array($shoppingcartItem->getExtraToppings())) {
                foreach ($shoppingcartItem->getExtraToppings() as $topping) {
                    OrderlineToppingService::create($orderlineid, $topping);
                }
            }
        }
    }
    
    public static function showOrderlines($orderid)
    {
        if (isset($orderid) && !empty($orderid)) {
            $result = OrderlineDAO::getByOrder($orderid);
            return $result;
        } else {
            throw new \Exception('attempting to run showOrderlines(orderid) with empty orderid');
        }
    }
}
