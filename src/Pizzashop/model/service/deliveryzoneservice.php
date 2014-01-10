<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\DeliveryzoneDAO;

/**
 * Description of deliveryzoneservice
 *
 * @author cyber02
 */
class DeliveryzoneService
{
    public static function getShopDeliveryzones($shopid)
    {
        if (isset($shopid)) {
            $result = DeliveryzoneDAO::getByShopid($shopid);
            return $result;
        }
    }
}
