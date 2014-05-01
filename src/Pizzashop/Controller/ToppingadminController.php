<?php

namespace Pizzashop\Controller;
use Framework\AbstractController;
use Pizzashop\Model\Service\ToppingService;

/**
 * Description of toppingadmincontroller
 * 
 * Controller that handles the topping admin section of the app.
 *
 * @author cyber02
 */
class ToppingAdminController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }

    
    public function viewAll()
    {
        //get topping list
        $toppings = ToppingService::showToppinglist();
        $this->render('toppingadminlist.twig', array(
            'toppings' => $toppings,
            ));
    }
    
    public function viewDetail($arguments)
    {
        //get single topping
        $id = $arguments[0];
        $topping = ToppingService::showTopping($id);
        //show details
        $this->render('toppingadmindetail.twig', array(
            'topping' => $topping,
            ));
    }
    
    public function viewNew()
    {
        //show empty toppingadmindetail form
        $this->render('toppingadmindetail.twig');
    }
    
    public function add()
    {
        //add new topping
        ToppingService::create($_POST);
        //redirect to toppinglist
        header('Location: '.ROOT.'/toppingadmin/viewall');
        exit();
    }
    
    public function save()
    {
        //update existing topping
        ToppingService::update($_POST);
        //redirect to toppinglist
        header('location: '.ROOT.'/toppingadmin/viewall/');
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
        //delete topping
        $id = $arguments[0];
        ToppingService::delete($id);
        //redirect to toppinglist
        header('location: '.ROOT.'/toppingadmin/viewall/');
        exit();
    }
}
