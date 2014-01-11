<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\ShoppingcartService;
use Pizzashop\Model\Service\ArticleService;
use Pizzashop\Model\Service\ToppingService;

/**
 * Description of ordercontroller
 *
 * @author cyber02
 */
class OrderController extends Controller
{
    public function go()
    {
        //get current shopping cart
        $this->model['cart'] = ShoppingcartService::getShoppingcart($_SESSION['user']);
//        var_dump($this->model['cart']);
        //display view
        $this->view = $this->app->environment->render('ordermenu.twig', array('cart' => $this->model['cart']));
        print($this->view);
    }
    
    public function selectPizza()
    {
        //get pizza articles
        $category = 'pizza';
        $this->model['articles'] = ArticleService::showArticlelistByCategory($category);
        $this->model['toppings'] = ToppingService::showToppinglist();
        //display view
        $this->view = $this->app->environment->render('orderselect.twig', array('articles' => $this->model['articles'],'toppings' => $this->model['toppings']));
        print($this->view);
    }
    
    public function selectBeverage()
    {
        //get pizza articles
        $category = 'drank';
        $this->model['articles'] = ArticleService::showArticlelistByCategory($category);
        //display view
        $this->view = $this->app->environment->render('orderselect.twig', array('articles' => $this->model['articles']));
        print($this->view);
    }
    
    public function addItem()
    {
        //add item to shoppingcart 
        ShoppingcartService::addItem($_SESSION['user'], $_POST);
        //redirect to order main screen
        header('location: /pizzashop/order/go/');
        exit();
    }
    
    public function removeItem($arguments)
    {
        //remove item from shoppingcart
        $index = $arguments[0];
        ShoppingcartService::removeItem($_SESSION['user'], $index);
        //redirect to order main screen
        header('location: /pizzashop/order/go');
        exit();
    }
    
    public function updateItems()
    {
        ShoppingcartService::updateItems($_SESSION['user'], $_POST);
        //redirect to order main screen
        header('location: /pizzashop/order/go');
        exit();
    }
    
    public function placeOrder()
    {
        ShoppingcartService::placeOrder($_SESSION['user']);
        //redirect to order confirmation
        header('location: /pizzashop/order/confirm');
        exit();
    }
    
    public function delivery()
    {
       //get current shopping cart
        $this->model['cart'] = ShoppingcartService::getShoppingcart($_SESSION['user']);
        //display delivery options view
        $this->view = $this->app->environment->render('deliverymenu.twig', array('cart' => $this->model['cart']));
        print($this->view);
    }
}