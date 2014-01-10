<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Entity;

/**
 * Description of deliveryzone
 *
 * @author cyber02
 */
class Deliveryzone
{
    private $shopid;
    private $postcode;
    private $delivery_cost;
    
    function __construct($shopid, $postcode, $delivery_cost)
    {
        $this->shopid = $shopid;
        $this->postcode = $postcode;
        $this->delivery_cost = $delivery_cost;
    }

    public function getShopid()
    {
        return $this->shopid;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }

    public function getDelivery_cost()
    {
        return $this->delivery_cost;
    }

    public function setShopid($shopid)
    {
        $this->shopid = $shopid;
    }

    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    public function setDelivery_cost($delivery_cost)
    {
        $this->delivery_cost = $delivery_cost;
    }
}
