<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Entity;

/**
 * Description of shoppingcart
 *
 * @author cyber02
 */
class Shoppingcart
{
    private $items;
    
    function __construct()
    {
        $this->items = array();
    }
    
    public function addItem($art, $qty)
    {
        $index = count($this->items)+1;
        $this->items[$index]['article'] = $art;
        $this->items[$index]['quantity'] = $qty;
    }
    
    public function removeItem($index)
    {
        
    }
    
    function getIndex()
    {
        if ($this->items) {
            
        }
    }
}
