<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Entity;
use Pizzashop\Model\Service\CustomerService;
use Pizzashop\Model\Service\ShopService;

/**
 * Description of shoppingcart
 *
 * @author cyber02
 */
class Shoppingcart
{
    private $customer;
    private $shop;
    private $items = array();
    
    function __construct($username, $shopid)
    {
        $this->customer = CustomerService::getCustomerByUsername($username);
        $this->shop = ShopService::getShop($shopid);
    }
    
    public function getCustomer()
    {
        return $this->customer;
    }

    public function getShop()
    {
        return $this->shop;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function setShop($shop)
    {
        $this->shop = $shop;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }
    
    public function addItem($item)
    {
        array_push($this->items, $item);
    }
    
    public function removeItem($index)
    {
        array_splice($this->items, $index, 1);
    }
}
