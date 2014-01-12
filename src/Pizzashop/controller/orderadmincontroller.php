<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\OrderService;
use Pizzashop\Model\Service\OrderstatusService;

/**
 * Description of orderadmincontroller
 *
 * @author Thomas
 */
class OrderadminController extends Controller
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function viewAll()
    {
        //get orders
        $this->model['orders'] = OrderService::showOrderlist();
        //get orderstatus
        $this->model['orderstatus'] = OrderstatusService::showOrderstatuslist();
        //display admin orderlist 
//        var_dump($this->model);
        $this->view = $this->app->environment->render('orderadminlist.twig', array('orders' => $this->model['orders'],'orderstatus' => $this->model['orderstatus']));
        print($this->view);
    }
    
    public function saveStatus()
    {
        //update status
        OrderService::updateOrderstatus($_POST);
        //redirect to list
        header('location: /pizzashop/orderadmin/viewall/');
        exit();
    }
}
