<?php

namespace Pizzashop\Controller;
use Library\Controller;

/**
 * Description of adminhomecontroller
 * 
 * Controller that shows the homepage of the admin section of the app.
 *
 * @author cyber02
 */
class AdminController extends Controller
{
    public function go()
    {
        $this->view = $this->app->environment->render('admin.twig');
        print($this->view);
    }
}
