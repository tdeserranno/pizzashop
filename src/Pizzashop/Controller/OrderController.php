<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Controller;
use Framework\AbstractController;
use Pizzashop\Model\Service\ShoppingcartService;
use Pizzashop\Model\Service\ArticleService;
use Pizzashop\Model\Service\ToppingService;

/**
 * Description of ordercontroller
 *
 * @author cyber02
 */
class OrderController extends AbstractController
{
    public function go()
    {
        //get current shopping cart
        $cart = ShoppingcartService::getShoppingcart($_SESSION['user']);
        //display view
        $this->render('ordermenu.twig', array(
            'cart' => $cart,
            ));
    }
    
    public function selectPizza()
    {
        //get pizza articles
        $category = 'pizza';
        $articles = ArticleService::showArticlelistByCategory($category);
        $toppings = ToppingService::showToppinglist();
        //display view
        $this->render('orderselect.twig', array(
            'articles' => $articles,
            'toppings' => $toppings,
            ));
    }
    
    public function selectBeverage()
    {
        //get pizza articles
        $category = 'drank';
        $articles = ArticleService::showArticlelistByCategory($category);
        //display view
        $this->render('orderselect.twig', array(
            'articles' => $articles,
            ));
    }
    
    public function addItem()
    {
        //add item to shoppingcart 
        ShoppingcartService::addItem($_SESSION['user'], $_POST);
        //redirect to order main screen
        header('location: '.ROOT.'/order/go/');
        exit();
    }
    
    public function removeItem($arguments)
    {
        //remove item from shoppingcart
        $index = $arguments[0];
        ShoppingcartService::removeItem($_SESSION['user'], $index);
        //redirect to order main screen
        header('location: '.ROOT.'/order/go');
        exit();
    }
    
    public function updateItems()
    {
        ShoppingcartService::updateItems($_SESSION['user'], $_POST);
        //redirect to order main screen
        header('location: '.ROOT.'/order/go');
        exit();
    }
    
    public function setDelivery()
    {
        ShoppingcartService::setDelivery($_SESSION['user'], $_POST);
        //redirect to order confirmation
        header('location: '.ROOT.'/order/confirm');
        exit();
    }
    
    public function placeOrder()
    {
        ShoppingcartService::placeOrder($_SESSION['user']);
        //redirect to order success
        header('location: '.ROOT.'/order/success');
        exit();
    }
    
    public function delivery()
    {
       //get current shopping cart
        $cart = ShoppingcartService::getShoppingcart($_SESSION['user']);
        //display delivery options view
        $this->render('deliverymenu.twig', array(
            'cart' => $cart,
            ));
    }
    
    public function confirm()
    {
        //get current shopping cart
        $cart = ShoppingcartService::getShoppingcart($_SESSION['user']);
        //display order confirmation
        $this->render('orderconfirm.twig', array(
            'cart' => $cart,
            ));
    }
    
    public function success()
    {
        //display order success
        $this->render('ordersuccess.twig');
    }
}