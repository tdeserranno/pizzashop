<?php

namespace Pizzashop\Controller;
use Pizzashop\Model\Service\CustomerService;
use Pizzashop\Model\Service\UserService;
use Framework\AbstractController;
use Pizzashop\Exception\FormException;

/**
 * Description of customeradmincontroller
 * 
 * Controller that handles the customer admin section of the app.
 *
 * @author cyber02
 */
class CustomerAdminController extends AbstractController
{
    public function viewAll()
    {
        //get all customers
        $customers = CustomerService::showCustomerlist();
        //show list
        $this->render('customeradminlist.twig', array(
            'customers' => $customers,
            ));
    }
    
    public function viewDetail($arguments)
    {
        //assign arguments
        $id = $arguments[0];

        //build model
        $customer = CustomerService::showCustomer($id);
        
        //check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['customerform'])) {
            //handle form
            try {
                 //update customer
                CustomerService::update($_POST);
                //redirect to customerlist
                header('location: '.ROOT.'/customeradmin/viewall/');
                exit();
            } catch (FormException $exc) {
                //render form with errors
                $this->render('customeradmindetail.twig', array(
                    'customer' => $customer,
                    'exception' => $exc,
                    ));
            }
        } else {
            //show customerdetail form
            $this->render('customeradmindetail.twig', array(
                'customer' => $customer,
                ));
        }
    }
    
    public function add()
    {
        //check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['customerform'])) {
            //handle form
            try {
                //create new user/customer
                UserService::registerUser($_POST);
                //redirect to customerlist
                header('location: '.ROOT.'/customeradmin/viewall/');
                exit;
            } catch (FormException $exc) {
                //render form with errors
                $this->render('customeradmindetail.twig', array(
                    'customer' => $customer,
                    'exception' => $exc,
                    ));
            }
        } else {
            //show empty customerdetail form
           $this->render('customeradmindetail.twig');
        }
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
        header('location: '.ROOT.'/customeradmin/viewall/');
        exit();
    }
}
