<?php

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
        if (isset($shopid) && !empty($shopid)) {
            $result = DeliveryzoneDAO::getByShopid($shopid);
            return $result;
        } else {
            throw new \Exception('attempting to run getShopDeliveryzones(shopid) with empty id');
        }
    }
}
