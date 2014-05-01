<?php

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\OrderlineToppingDAO;

/**
 * Description of orderlinetoppingservice
 *
 * @author Thomas
 */
class OrderlineToppingService
{
    public static function create($orderlineid, $topping)
    {
        if (isset($orderlineid, $topping) && !empty($orderlineid) && is_object($topping)) {
            OrderlineToppingDAO::create($orderlineid, $topping->getId());
        }
    }
    
    public static function getByOrderline($orderlineid)
    {
        if (isset($orderlineid) && !empty($orderlineid)) {
            $result = OrderlineToppingDAO::getToppingsByOrderline($orderlineid);
            return $result;
        } else {
            throw new \Exception('attempting to run getByOrderline(orderlineid) with empty orderlineid');
        }
    }
}
