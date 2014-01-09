<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\CustomerDAO;


/**
 * Description of customerservice
 *
 * @author cyber02
 */
class CustomerService
{
    public static function showCustomerlist()
    {
        $result = CustomerDAO::getAll();
        return $result;
    }
    
    public static function showCustomer($arguments)
    {
        $id = $arguments[0];
        $result = CustomerDAO::getById($id);
        return $result;
    }
    
    public static function createCustomer($post)
    {
        if (isset($post)) {
            CustomerDAO::create($post['firstname'],
                    $post['lastname'],
                    $post['address'],
                    $post['postcode'],
                    $post['city'],
                    $post['telephone'],
                    $post['username']);
        }
    }
    
    public static function update($post)
    {
        if (isset($post['id'])) {
            CustomerDAO::update($post['id'],
                    $post['firstname'],
                    $post['lastname'],
                    $post['address'],
                    $post['postcode'],
                    $post['city'],
                    $post['telephone'],
                    $post['active_status']);
        }
    }
    
    public static function delete($arguments)
    {
        if (isset($arguments[0])) {
            $id = $arguments[0];
            //get customer username
            $username = CustomerDAO::getById($id)->getUsername();
            //delete user
            UserService::deleteUser($username);
            //delete customer
            CustomerDAO::delete($id);
        }
    }
}
