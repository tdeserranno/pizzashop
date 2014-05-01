<?php

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\ShoppingcartDAO;
use Pizzashop\Model\Entity\ShoppingcartItem;
use Pizzashop\Model\Service\ArticleService;
use Pizzashop\Model\Service\ToppingService;
use Pizzashop\Model\Service\UserService;

/**
 * Description of shoppingcartservice
 *
 * @author cyber02
 */
class ShoppingcartService
{
    public static function getShoppingcart()
    {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            //retrieve cart from session
            $shoppingcart = ShoppingcartDAO::getSessionCart($cart);
        } else {
            //create new cart
            $user = UserService::unserializeFromSession();
            $shoppingcart = ShoppingcartDAO::create($user->getUsername(), 1);
            //set cart in session
            self::setShoppingcart($shoppingcart);
        }
        //check if customer is active, if true return shoppingcart
        if ($shoppingcart->getCustomer()->getActive_status() == 1) {
            return $shoppingcart;
        } else {
            ShoppingcartDAO::destroy();
            throw new \Exception('customer does not have active status');
        }
    }
    
    public static function setShoppingcart($shoppingcart)
    {
        if (isset($shoppingcart) && !empty($shoppingcart) && is_object($shoppingcart)) {
            ShoppingcartDAO::setSessionCart($shoppingcart);
        }
    }
    
    public static function addItem($sessionuser, $post)
    {
        if (isset($sessionuser, $post)) {
            //get shoppingcart
            $shoppingcart = self::getShoppingcart($sessionuser);
            //create object of selected article
            $article = ArticleService::showArticle($post['id']);
            //create toppings array for selected article
            $extratoppings = array();
            foreach ($post['toppings'] as $toppingid) {
                $topping = ToppingService::showTopping($toppingid);
                array_push($extratoppings, $topping);
            }
            //create new shoppingcartitem object
            $item = new ShoppingcartItem($article, $extratoppings, $post['quantity']);
            //add item to shoppingcart
            $shoppingcart->addItem($item);
            //set shoppingcart in session
            self::setShoppingcart($shoppingcart);
        }
    }
    
    public static function removeItem($sessionuser, $index)
    {
        if (isset($sessionuser, $index)) {
            //get cart from session
            $shoppingcart = self::getShoppingcart($sessionuser);
            //remove item from shoppingcart
            $shoppingcart->removeItem($index);
            //set cart in session
            self::setShoppingcart($shoppingcart);
        }
    }
    
    public static function updateItems($sessionuser, $post)
    {
        if (isset($sessionuser, $post)) {
            //get cart from session
            $shoppingcart = self::getShoppingcart($sessionuser);
            //update items in shoppingcart
            $shoppingcart->updateItems($post['quantity']);
            //set cart in session
            self::setShoppingcart($shoppingcart);
        }
    }
    
    public static function setDelivery($sessionuser, $post)
    {
        if (isset($sessionuser, $post)) {
            //get cart from session
            $shoppingcart = self::getShoppingcart($sessionuser);
            //set delivery options
            $shoppingcart->setDeliverytype($post['delivery']);
            $shoppingcart->setDeliverycost($post['deliverycost']);
            //set cart in session
            self::setShoppingcart($shoppingcart);
        }
    }
    
    public static function placeOrder($sessionuser)
    {
        if (isset($sessionuser)) {
            //get cart from session
            $shoppingcart = self::getShoppingcart($sessionuser);
            //create order in DB
            OrderService::create($shoppingcart);
            //destroy shoppingcart
            ShoppingcartDAO::destroy();
        }
    }
}
