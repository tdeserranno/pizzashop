<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        OrderlineToppingDAO::create($orderlineid, $topping->getId());
    }
    
    public static function getByOrderline($orderlineid)
    {
        $result = OrderlineToppingDAO::getToppingsByOrderline($orderlineid);
        return $result;
    }
}
