<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Controller;
use Framework\AbstractController;
use Pizzashop\Model\Service\OrderService;
use Pizzashop\Model\Service\OrderstatusService;
use Pizzashop\Model\Service\CustomerService;

/**
 * Description of orderadmincontroller
 *
 * @author Thomas
 */
class OrderadminController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function viewAll()
    {
        //get orders
        $orders = OrderService::showOrderlist();
        //get orderstatus
        $orderstatus = OrderstatusService::showOrderstatuslist();
        //get customers
        $customers = CustomerService::showCustomerlist();
        //display admin orderlist 
        $this->render(
                'orderadminlist.twig',
                array(
                    'orders' => $orders,
                    'orderstatus' => $orderstatus,
                    'customers' => $customers,
                    ));
    }
    
    public function viewCustomer()
    {
        //get orders
        $orders = OrderService::showOrdersByCustomer($_POST['customer']);
        //get orderstatus
        $orderstatus = OrderstatusService::showOrderstatuslist();
        //get customers
        $customers = CustomerService::showCustomerlist();
        //display admin orderlist 
        $this->render(
                'orderadminlist.twig',
                array(
                    'orders' => $orders,
                    'orderstatus' => $orderstatus,
                    'customers' => $customers,
                    'selectedcustomer' => $_POST['customer'],
                    ));
    }

    public function saveStatus()
    {
        //update status
        OrderService::updateOrderstatus($_POST);
        //redirect to list
        header('location: '.ROOT.'/orderadmin/viewall/');
        exit();
    }
}
