<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Controller;
use Library\Controller;

/**
 * Description of managehomecontroller
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
