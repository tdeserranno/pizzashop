<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Entity;
use Pizzashop\Model\Entity\Article;

/**
 * Description of pizza
 *
 * @author cyber02
 */
class Pizza extends Article
{
    private $toppings = array();
    
    function __construct($id, $name, $description, $image, $price, $promo_status, $category, $toppings)
    {
        parent::__construct($id, $name, $description, $image, $price, $promo_status, $category);
        $this->toppings = $toppings;
    }

}
