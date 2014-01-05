<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Library;
/**
 * Description of controller
 *
 * @author Thomas
 */
class Controller
{
    protected $app;
    protected $model;
    protected $view;
    
    function __construct($app)
    {
//        echo 'base controller<br>';
        $this->app = $app;
    }
}
