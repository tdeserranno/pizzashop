<?php

namespace Library;
use Library\Exception\AuthenticationException;
/**
 * Description of helper
 * 
 * Application Helper class containing helper functions
 *
 * @author cyber02
 */
class Helper
{
    public function sec_session_start()
    {
        $session_name = 'sec_session_id'; //set a custom session name
        $secure = false; //set to true if using https
        $httponly = true; //stops javascript access to session id
        ini_set('session.use_only_cookies',1); //forces sessions to only use cookies
        $cookieParams = session_get_cookie_params(); //gets current cookies params
        session_set_cookie_params($cookieParams['lifetime'], $cookieParams['path'], $cookieParams['domain'], $secure, $httponly);
        session_name($session_name); //sets session name to custom name set above
        session_start(); //start php session
        session_regenerate_id();    
    }

    public function check_access_allowed()
    {
        //determine requested controller
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
        $controller = !empty($url[0]) ? strtolower($url[0]) : 'home';
        //array containing the names of controller that are accessible to
        //public users
        $public_access = array('home','auth','menu');
        //test if requested controller needs login
        if (!in_array($controller, $public_access)){
            //test if SESSION var indicating login status is set
            if (!isset($_SESSION['user'])) {
                throw new AuthenticationException('Not logged in',1);
            } 
        }
    }
}
