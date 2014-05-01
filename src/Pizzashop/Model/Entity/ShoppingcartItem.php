<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Entity;

/**
 * Description of shoppingcartitem
 *
 * @author cyber02
 */
class ShoppingcartItem
{
    private $article;
    private $extraToppings;
    private $quantity;
    
    function __construct($article, $extraToppings, $quantity)
    {
        $this->article = $article;
        $this->extraToppings = $extraToppings;
        $this->quantity = $quantity;
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function getExtraToppings()
    {
        return $this->extraToppings;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setArticle($article)
    {
        $this->article = $article;
    }

    public function setExtraToppings($extraToppings)
    {
        $this->extraToppings = $extraToppings;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getCost()
    {
        $cost = $this->article->getCost();
        foreach ($this->extraToppings as $topping) {
            $cost = $cost + $topping->getPrice();
        }
        return $cost;
    }
    
    public function getTotal()
    {
        $cost = $this->getCost();
        $total = $cost * $this->quantity;
        return $total;
    }
}
