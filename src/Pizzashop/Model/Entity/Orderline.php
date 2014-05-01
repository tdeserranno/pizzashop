<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Entity;

/**
 * Description of orderline
 *
 * @author Thomas
 */
class Orderline
{
    private $article;
    private $quantity;
    private $price;
    private $toppings = array();
    
    function __construct($article, $quantity, $price, $toppings)
    {
        $this->article = $article;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->toppings = $toppings;
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getToppings()
    {
        return $this->toppings;
    }

    public function setArticle($article)
    {
        $this->article = $article;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setToppings($toppings)
    {
        $this->toppings = $toppings;
    }
}
