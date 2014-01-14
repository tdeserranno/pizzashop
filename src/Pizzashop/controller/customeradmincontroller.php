<?php

namespace Pizzashop\Controller;
use Pizzashop\Model\Service\CustomerService;
use Pizzashop\Model\Service\UserService;
use Library\Controller;

/**
 * Description of customeradmincontroller
 * 
 * Controller that handles the customer admin section of the app.
 *
 * @author cyber02
 */
class CustomerAdminController extends Controller
{
    public function viewAll()
    {
        //get all customers
        $this->model['customers'] = CustomerService::showCustomerlist();
        //show list
        $this->view = $this->app->environment->render('customeradminlist.twig', array('customers' => $this->model['customers']));
        print($this->view);
    }
    
    public function viewDetail($arguments)
    {
        //get single customer
        $id = $arguments[0];
        $this->model['customer'] = CustomerService::showCustomer($id);
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
    
    /**One problem that needs to be addressed is to make it impossible for a
     * delete method to run in any other way other than if it was started from
     * the correct page. Since we are supplying the id of the record to be
     * deleted in the URI someone could manually type in a different url with
     * a different id.
     * 
     * Solution: to be determined and implemented.
     * 
     * @param type $arguments
     */
    public function delete($arguments)
    {
        //delete customer
        $id = $arguments[0];
        CustomerService::delete($id);
        //redirect to customerlist
        header('location: /pizzashop/customeradmin/viewall/');
        exit();
    }
}
