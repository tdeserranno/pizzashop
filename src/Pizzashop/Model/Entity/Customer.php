<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Entity;

/**
 * Description of customer
 *
 * @author cyber02
 */
class Customer
{
    private $id;
    private $firstname;
    private $lastname;
    private $address;
    private $postcode;
    private $city;
    private $telephone;
    private $active_status;
    private $username;
    
    function __construct($id, $firstname, $lastname, $address, $postcode, $city, $telephone, $active_status, $username)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->address = $address;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->telephone = $telephone;
        $this->active_status = $active_status;
        $this->username = $username;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
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

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getActive_status()
    {
        return $this->active_status;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
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

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function setActive_status($active_status)
    {
        $this->active_status = $active_status;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    public function getFullName()
    {
        $fullname = $this->firstname.' '.$this->lastname;
        return $fullname;
    }
}
