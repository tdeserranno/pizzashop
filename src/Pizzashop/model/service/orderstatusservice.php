<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\OrderstatusDAO;

/**
 * Description of orderstatusservice
 *
 * @author Thomas
 */
class OrderstatusService
{
    public static function showOrderstatuslist()
    {
        $result = OrderstatusDAO::getAll();
        return $result;
    }
    
    public static function showOrderstatus($id)
    {
        $result = OrderstatusDAO::getById($id);
        return $result;
    }
            
}
