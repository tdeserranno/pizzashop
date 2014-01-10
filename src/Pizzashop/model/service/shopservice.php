<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        if (isset($id)) {
            $result = ShopDAO::getById($id);
            return $result;
        }
    }
}
