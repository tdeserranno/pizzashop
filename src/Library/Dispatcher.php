<?php

namespace Library;
use Library\Exception\DispatcherException;

/**
 * Description of Dispatcher
 * Dispatcher class takes apart the URI and attempts to load the requested
 * controller and method.
 * 
 * @author cyber02
 */
class Dispatcher
{
    protected $app;
    
    function __construct($app)
    {
        $this->app = $app;
    }

    public function run()
    {
        //process url, trim any leading and trailing slashes
        $url = trim($_SERVER['REQUEST_URI'],'/');
        /**
         * In the current localhost environment the first part of the
         * exploded url will be the project name. In a publised app this
         * would not be present.
         * An array_shift simply shifts the project name out of the array
         */
        //explode url and shift projectname
        $url = explode('/', $url);
        array_shift($url);
        //get controller name, if empty use default
        $controllerName = !empty($url[0]) ? ucfirst(strtolower($url[0])).'Controller' : 'HomeController';
        array_shift($url);
        //get method name, if empty use default
        $methodName = !empty($url[0]) ? strtolower($url[0]) : 'go';
        array_shift($url);
        //get arguments, if empty set to null
        $arguments = !empty($url) ? $url : null;
        //set application controller namespace
        $namespace = $this->app->getAppName().'\Controller\\';
        //set fully qualified controller name
        $controllerNameFQ = $namespace.$controllerName;
        //test if dispatcher autoloader can load controller
        if ($this->app->getAppLoader()->canLoadClass($controllerNameFQ)) {
            //create controller and pass along the twig environment (subject to change in future)
//            $controller = new $controllerNameFQ($this->twig);
            $controller = new $controllerNameFQ($this->app);
            //test if requested method exists for created controller
            if (method_exists($controller, $methodName)) {
                //call method and pass arguments
                $controller->$methodName($arguments);
            } else {
                throw new DispatcherException('Unknown method');
            }
        } else {
            throw new DispatcherException('Unknown controller');
        }
    }
}
