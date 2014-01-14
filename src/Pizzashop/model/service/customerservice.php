<?php

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
    
    public static function showCustomer($id)
    {
        if (isset($id) && !empty($id)) {
            $result = CustomerDAO::getById($id);
            return $result;
        } else {
            throw new \Exception('attempting to run showCustomer(id) with empty id');
        }
    }
    
    public static function createCustomer($post)
    {
        if (isset($post)) {
            if (isset($post['active_status']) && $post['active_status'] == 'yes') {
                $active = true;
            } else {
                $active = false;
            }
            CustomerDAO::create($post['firstname'],
                    $post['lastname'],
                    $post['address'],
                    $post['postcode'],
                    $post['city'],
                    $post['telephone'],
                    $active,
                    $post['username']);
        }
    }
    
    public static function update($post)
    {
        if (isset($post['id']) && !empty($post['id'])) {
            if (isset($post['active_status']) && $post['active_status'] == 'yes') {
                $active = true;
            } else {
                $active = false;
            }
            CustomerDAO::update($post['id'],
                    $post['firstname'],
                    $post['lastname'],
                    $post['address'],
                    $post['postcode'],
                    $post['city'],
                    $post['telephone'],
                    $active);
        }
    }
    
    public static function delete($id)
    {
        if (isset($id) && !empty($id)) {
            //get customer username
            $username = CustomerDAO::getById($id)->getUsername();
            //delete customer user
            UserService::deleteUser($username);
            //delete customer
            CustomerDAO::delete($id);
        }
    }
    
    public static function getCustomerByUsername($username)
    {
        if (isset($username) && !empty($username)) {
            $result = CustomerDAO::getByUsername($username);
            return $result;
        } else {
            throw new \Exception('attempting to run getCustomerByUsername(username) with empty username');
        }
    }
    
    public static function showOpenOrderCustomers()
    {
        $result = CustomerDAO::getUndeliveredCustomers();
        return $result;
    }
}
