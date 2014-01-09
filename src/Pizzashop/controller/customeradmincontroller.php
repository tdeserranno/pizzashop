<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Controller;
use Pizzashop\Model\Service\CustomerService;
use Pizzashop\Model\Service\UserService;
use Library\Controller;

/**
 * Description of customerscontroller
 *
 * @author cyber02
 */
class CustomerAdminController extends Controller
{
    public function viewAll()
    {
        //get all customers
        $this->model = CustomerService::showCustomerlist();
        //show list
        $this->view = $this->app->environment->render('customeradminlist.twig', array('customers' => $this->model['customers']));
        print($this->view);
    }
    
    public function viewDetail($arguments)
    {
        //get single customer
        $this->model = CustomerService::showCustomer($arguments);
        //show details
        $this->view = $this->app->environment->render('customeradmindetail.twig', array('customer' => $this->model['customer']));
        print($this->view);
    }
    
    public function viewNew()
    {
        //show empty customeradmindetail form
        $this->view = $this->app->environment->render('customeradmindetail.twig');
        print($this->view);
    }
    
    public function add()
    {
        //process new user/customer
        UserService::registerUser($_POST);
        //redirect to customerlist
        header('location: /pizzashop/customeradmin/viewall/');
        exit;
    }
    
    public function save()
    {
        //update existing customer
        CustomerService::update($_POST);
        //redirect to customerlist
        header('location: /pizzashop/customeradmin/viewall/');
        exit();
    }
    
    public function delete($arguments)
    {
        //delete customer
        CustomerService::delete($arguments);
        //redirect to customerlist
        header('location: /pizzashop/customeradmin/viewall/');
        exit();
    }
}
