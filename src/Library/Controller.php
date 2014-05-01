<?php

namespace Library;
/**
 * Description of controller
 * 
 * Framework base controller class containing the application class,
 * model and view variable.
 * 
 * All controllers created in an application need to extend this class to have
 * access to the class loaders and twig environment.
 *
 * Verkeerd???
 * controller zou moeten onderdeel zijn van application class en niet opgekeerd?
 * aanpassingen later maken?
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
