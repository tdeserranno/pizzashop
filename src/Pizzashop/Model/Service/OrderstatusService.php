<?php

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
        if (isset($id) && !empty($id)) {
            $result = OrderstatusDAO::getById($id);
            return $result;
        } else {
            throw new \Exception('attempting to run showOrderstatus(id) with empty id');
        }
    }
}
