<?php

namespace Pizzashop\Controller;

use Framework\AbstractController;

/**
 * Description of adminhomecontroller
 * 
 * Controller that shows the homepage of the admin section of the app.
 *
 * @author cyber02
 */
class AdminController extends AbstractController
{
    public function go()
    {
        $this->render('admin.twig');
    }
}
