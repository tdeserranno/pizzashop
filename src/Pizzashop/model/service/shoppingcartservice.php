<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\ShoppingcartDAO;
use Pizzashop\Model\Entity\ShoppingcartItem;
use Pizzashop\Model\Service\ArticleService;
use Pizzashop\Model\Service\ToppingService;

/**
 * Description of shoppingcartservice
 *
 * @author cyber02
 */
class ShoppingcartService
{
    public static function getShoppingcart($sessionuser)
    {
        if (isset($sessionuser['cart']) && !empty($sessionuser['cart'])) {
            $cart = $sessionuser['cart'];
            //retrieve cart from session
            $shoppingcart = ShoppingcartDAO::getSessionCart($cart);
        } else {
            //create new cart
            $username = $sessionuser['username'];
            $shoppingcart = ShoppingcartDAO::create($username, 1);
            self::setShoppingcart($shoppingcart);
        }
        return $shoppingcart;
    }
    
    public static function setShoppingcart($shoppingcart)
    {
        if (isset($shoppingcart) && !empty($shoppingcart)) {
            ShoppingcartDAO::setSessionCart($shoppingcart);
        }
    }
    
    public static function addItem($sessionuser, $post)
    {
        $shoppingcart = self::getShoppingcart($sessionuser);
        $article = ArticleService::showArticle($post['id']);
        $extratoppings = array();
        foreach ($post['toppings'] as $toppingid) {
            $topping = ToppingService::showTopping($toppingid);
            array_push($extratoppings, $topping);
        }
        $item = new ShoppingcartItem($article, $extratoppings, $post['quantity']);
        $shoppingcart->addItem($item);
        self::setShoppingcart($shoppingcart);
    }
    
    public static function removeItem($sessionuser, $index)
    {
        $shoppingcart = self::getShoppingcart($sessionuser);
        if (isset($index) && $index !== null) {
            $shoppingcart->removeItem($index);
        }
        self::setShoppingcart($shoppingcart);
    }
    
    public static function updateItems($sessionuser, $post)
    {
        $shoppingcart = self::getShoppingcart($sessionuser);
        $shoppingcart->updateItems($post['quantity']);
        self::setShoppingcart($shoppingcart);
    }
    
    public static function placeOrder($sessionuser, $post)
    {
        $shoppingcart = self::getShoppingcart($sessionuser);
        //set delivery options
        $shoppingcart->setDeliverytype($post['delivery']);
        //create order in DB
        
        //destroy shoppingcart
    }
}
