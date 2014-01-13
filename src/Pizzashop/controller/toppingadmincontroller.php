<?php

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\ToppingService;

/**
 * Description of toppingadmincontroller
 * 
 * Controller that handles the topping admin section of the app.
 *
 * @author cyber02
 */
class ToppingAdminController extends Controller
{
    function __construct($app)
    {
        parent::__construct($app);
    }

    
    public function viewAll()
    {
        //get topping list
        $this->model['toppings'] = ToppingService::showToppinglist();
        $this->view = $this->app->environment->render('toppingadminlist.twig', array('toppings' => $this->model['toppings']));
        print($this->view);
    }
    
    public function viewDetail($arguments)
    {
        //get single topping
        $id = $arguments[0];
        $this->model['topping'] = ToppingService::showTopping($id);
        //show details
        $this->view = $this->app->environment->render('toppingadmindetail.twig', array('topping' => $this->model['topping']));
        print($this->view);
    }
    
    public function viewNew()
    {
        //show empty toppingadmindetail form
        $this->view = $this->app->environment->render('toppingadmindetail.twig');
        print($this->view);
    }
    
    public function add()
    {
        //add new topping
        ToppingService::create($_POST);
        //redirect to toppinglist
        header('Location: /pizzashop/toppingadmin/viewall');
        exit();
    }
    
    public function save()
    {
        //update existing topping
        ToppingService::update($_POST);
        //redirect to toppinglist
        header('location: /pizzashop/toppingadmin/viewall/');
        exit();
    }
    
    public function delete($arguments)
    {
        //delete topping
        $id = $arguments[0];
        ToppingService::delete($id);
        //redirect to toppinglist
        header('location: /pizzashop/toppingadmin/viewall/');
        exit();
    }
}
