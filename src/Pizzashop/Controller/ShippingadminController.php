<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Controller;
use Framework\AbstractController;
use Pizzashop\Model\Service\CustomerService;
use Pizzashop\Model\Service\OrderService;

/**
 * Description of shippingadmincontroller
 *
 * @author cyber02
 */
class ShippingAdminController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }

    public function viewList()
    {
        //get customers with undelivered orders
        $customers = CustomerService::showOpenOrderCustomers();
        //get undelivered orders
        $orders = OrderService::showOpenOrders();
        //get subtotals
        $customerTotals = OrderService::showOpenOrdersCustomerTotals();
        //get total
        $total = OrderService::showOpenOrdersTotal();
        //display view
        $this->render(
                'shippingadminlist.twig',
                array(
                    'orders' => $orders,
                    'customers' => $customers,
                    'customertotals' => $customerTotals,
                    'total' => $total,
                ));
    }
}
