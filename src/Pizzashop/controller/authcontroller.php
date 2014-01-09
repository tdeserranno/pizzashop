<?php

namespace Pizzashop\Controller;
use Library\Controller;
use Pizzashop\Model\Service\UserService;

/**
 * Description of auth
 *
 * @author Thomas
 */
class AuthController extends Controller
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function go()
    {
        //display login screen
        $this->view = $this->app->environment->render('login.twig');
        print($this->view);
    }
    
    public function signup()
    {
        //display signup form
        $this->view = $this->app->environment->render('signup.twig');
        print($this->view);
    }
    
    public function register()
    {
        //process user/customer registration
        UserService::registerUser($_POST);
        //redirect to login
        header('location: /pizzashop/auth/go/');
        exit();
    }
    
    public function login()
    {
        UserService::loginUser();
    }
    
    public function logout()
    {
        UserService::logoutUser();
    }
}
