<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Shoppingcart;

/**
 * Description of shoppingcartdao
 *
 * @author cyber02
 */
class ShoppingcartDAO
{
    public static function create($username,$shopid)
    {
        $shoppingcart = new Shoppingcart($username, $shopid);
        return $shoppingcart;
    }
    
    public static function destroy()
    {
        if (isset($_SESSION['cart'])) {
            unset ($_SESSION['cart']);
        }
    }
    
    public static function getSessionCart($cart)
    {
        if (isset($cart) && !empty($cart)) {
            //retrieve cart from session
            $shoppingcart = unserialize($cart);
        }
        return $shoppingcart;
    }
    
    public static function setSessionCart($shoppingcart)
    {
        if (isset($shoppingcart) && !empty($shoppingcart)) {
            //store cart in session
            $cart = serialize($shoppingcart);
            $_SESSION['cart'] = $cart;
        }
    }
}
