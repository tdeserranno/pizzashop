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
        //this array needs to be moved outside of the helper class !!! TODO
        //possibly implement ACL with decorator pattern
        $public_access = array('pizzashop/auth/go',
                                'pizzashop/auth/signup',
                                'pizzashop/auth/register',
                                'pizzashop/auth/login',
                                'pizzashop/auth/logout',
                                'pizzashop/home',
                                'pizzashop/home/go',
                                'pizzashop');
        //test if URI points to something private
        if (!in_array(trim($_SERVER['REQUEST_URI'], '/'), $public_access)){
            //test if SESSION var indicating login status is set
            if (!isset($_SESSION['user'])) {
                throw new AuthenticationException('Not logged in',1);
            } 
        }
    }
}
