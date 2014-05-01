<?php

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\ShopDAO;

/**
 * Description of shopservice
 *
 * @author cyber02
 */
class ShopService
{
    public static function getShop($id)
    {
        if (isset($id) && !empty($id)) {
            $result = ShopDAO::getById($id);
            return $result;
        } else {
            throw new \Exception('attempting to run getShop(id) with empty id');
        }
    }
}
