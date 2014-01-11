<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Entity;

/**
 * Description of order
 *
 * @author Thomas
 */
class Order
{
    private $id;
    private $date;
    private $delivery_type;
    private $delivery_time;
    private $orderstatus;
    private $customer;
    private $shop;
    private $orderlines = array();
    
    function __construct($id, $date, $delivery_type, $orderstatus, $customer, $shop, $orderlines)
    {
        $this->id = $id;
        $this->date = $date;
        $this->delivery_type = $delivery_type;
        $this->orderstatus = $orderstatus;
        $this->customer = $customer;
        $this->shop = $shop;
        $this->orderlines = $orderlines;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDelivery_type()
    {
        return $this->delivery_type;
    }

    public function getDelivery_time()
    {
        return $this->delivery_time;
    }

    public function getOrderstatus()
    {
        return $this->orderstatus;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function getShop()
    {
        return $this->shop;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setDelivery_type($delivery_type)
    {
        $this->delivery_type = $delivery_type;
    }

    public function setDelivery_time($delivery_time)
    {
        $this->delivery_time = $delivery_time;
    }

    public function setOrderstatus($orderstatus)
    {
        $this->orderstatus = $orderstatus;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function setShop($shop)
    {
        $this->shop = $shop;
    }
    
    public function getOrderlines()
    {
        return $this->orderlines;
    }

    public function setOrderlines($orderlines)
    {
        $this->orderlines = $orderlines;
    }
}
