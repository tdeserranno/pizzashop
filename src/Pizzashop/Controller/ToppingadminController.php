<?php

namespace Pizzashop\Controller;
use Framework\AbstractController;
use Pizzashop\Model\Service\ToppingService;
use Pizzashop\Exception\FormException;

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
        //assign arguments
        $id = $arguments[0];

        //build model
        $topping = ToppingService::showTopping($id);
        
        //check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toppingform'])) {
            //handle form
            try {
                //update existing topping
                ToppingService::update($_POST);
                //redirect to toppinglist
                header('location: '.ROOT.'/toppingadmin/viewall/');
                exit();
            } catch (FormException $exc) {
                //render form with errors
                $this->render('toppingadmindetail.twig', array(
                    'topping' => $topping,
                    'exception' => $exc,
                        ));
            }
        } else {
            //show empty articledetail form
            $this->render('toppingadmindetail.twig', array(
                'topping' => $topping,
                ));
        }
    }
    
    public function add()
    {
        //check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toppingform'])) {
            //handle form
            try {
                //add new topping
                ToppingService::create($_POST);
                //redirect to toppinglist
                header('Location: '.ROOT.'/toppingadmin/viewall');
                exit();
            } catch (FormException $exc) {
                //render form with errors
                $this->render('toppingadmindetail.twig', array(
                    'exception' => $exc,
                        ));
            }
        } else {
            //show empty articledetail form
            $this->render('toppingadmindetail.twig');
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
        //delete topping
        $id = $arguments[0];
        ToppingService::delete($id);
        //redirect to toppinglist
        header('location: '.ROOT.'/toppingadmin/viewall/');
        exit();
    }
}
