<?php

namespace Pizzashop\Controller;
use Framework\AbstractController;

/**
 * Description of homecontroller
 * 
 * Controller that shows the application homepage.
 *
 * @author Thomas
 */
class HomeController extends AbstractController
{
    public function go()
    {
        $this->render('home.twig');
    }
}
