<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Entity;

/**
 * Description of article
 *
 * @author cyber02
 */
class Article
{
    protected $id;
    protected $name;
    protected $description;
    protected $image;
    protected $price;
    protected $promo_status;
    protected $promo_price;
    protected $category;
    
    function __construct($id, $name, $description, $image, $price, $promo_status, $promo_price, $category)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->promo_status = $promo_status;
        $this->promo_price = $promo_price;
        $this->category = $category;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getPromo_status()
    {
        return $this->promo_status;
    }

    public function getPromo_price()
    {
        return $this->promo_price;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setPromo_status($promo_status)
    {
        $this->promo_status = $promo_status;
    }

    public function setPromo_price($promo_price)
    {
        $this->promo_price = $promo_price;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
    
    public function getCost()
    {
        if ($this->promo_status == 1) {
            return $this->promo_price;
        } else {
            return $this->price;
        }
    }
}
   