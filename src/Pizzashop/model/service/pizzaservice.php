<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\PizzaDAO;

/**
 * Description of pizzaservice
 *
 * @author cyber02
 */
class PizzaService
{
    public static function getPizza($id)
    {
        $result = PizzaDAO::getById($id);
        return $result;
    }
}
