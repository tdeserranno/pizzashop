<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\ToppingService;

/**
 * Description of toppingadmincontroller
 *
 * @author cyber02
 */
class ToppingAdminController extends Controller
{
    function __construct($app)
    {
        parent::__construct($app);
    }

    
    public function viewAll()
    {
        //get topping list
        $this->model = ToppingService::showToppinglist();
        $this->view = $this->app->environment->render('toppingadminlist.twig', array('toppings' => $this->model['toppings']));
        print($this->view);
    }
    
    public function viewDetail($arguments)
    {
        //get single topping
        $this->model = ToppingService::showTopping($arguments);
        //show details
        $this->view = $this->app->environment->render('toppingadmindetail.twig', array('topping' => $this->model['topping']));
        print($this->view);
    }
    
    public function viewNew()
    {
        //show empty toppingadmindetail form
        $this->view = $this->app->environment->render('toppingadmindetail.twig');
        print($this->view);
    }
    
    public function add()
    {
        //add new topping
        ToppingService::create($_POST);
        //redirect to toppinglist
        header('Location: /pizzashop/toppingadmin/viewall');
        exit();
    }
    
    public function save()
    {
        //update existing topping
        ToppingService::update($_POST);
        //redirect to toppinglist
        header('location: /pizzashop/toppingadmin/viewall/');
        exit();
    }
    
    public function delete($arguments)
    {
        //delete topping
        ToppingService::delete($arguments);
        //redirect to toppinglist
        header('location: /pizzashop/toppingadmin/viewall/');
        exit();
    }
}
