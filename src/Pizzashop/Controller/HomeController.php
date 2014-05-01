<?php

namespace Pizzashop\Controller;
use Library\Controller;

/**
 * Description of homecontroller
 * 
 * Controller that shows the application homepage.
 *
 * @author Thomas
 */
class HomeController extends Controller
{
    public function go()
    {
        $this->view = $this->app->environment->render('home.twig');
        print($this->view);
    }
}
