<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Entity;

/**
 * Description of shop
 *
 * @author cyber02
 */
class Shop
{
    private $id;
    private $address;
    private $postcode;
    private $city;
    private $deliveryzones;
    
    function __construct($id, $address, $postcode, $city, $deliveryzones)
    {
        $this->id = $id;
        $this->address = $address;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->deliveryzones = $deliveryzones;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getDeliveryzones()
    {
        return $this->deliveryzones;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setDeliveryzones($deliveryzones)
    {
        $this->deliveryzones = $deliveryzones;
    }
}
