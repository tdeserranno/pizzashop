<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\CustomerService;
use Pizzashop\Model\Service\OrderService;

/**
 * Description of shippingadmincontroller
 *
 * @author cyber02
 */
class ShippingAdminController extends Controller
{
    function __construct($app)
    {
        parent::__construct($app);
    }

    public function viewList()
    {
        //get customers with undelivered orders
        $this->model['customers'] = CustomerService::showOpenOrderCustomers();
        //get undelivered orders
        $this->model['orders'] = OrderService::showOpenOrders();
        //get subtotals
        $this->model['customertotals'] = OrderService::showOpenOrdersCustomerTotals();
        //get total
        $this->model['total'] = OrderService::showOpenOrdersTotal();
        //display view
        $this->view = $this->app->environment->render(
                'shippingadminlist.twig',
                array(
                    'orders' => $this->model['orders'],
                    'customers' => $this->model['customers'],
                    'customertotals' => $this->model['customertotals'],
                    'total' => $this->model['total']
                ));
        print($this->view);
        
    }
}
