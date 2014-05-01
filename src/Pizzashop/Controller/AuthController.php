<?php

namespace Pizzashop\Controller;
use Framework\AbstractController;
use Pizzashop\Model\Service\UserService;

/**
 * Description of authcontroller
 * 
 * Controller that handles user authentication
 *
 * @author Thomas
 */
class AuthController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function go()
    {
        //display login screen
        $this->render('login.twig');
    }
    
    public function signup()
    {
        //display signup form
        $this->render('signup.twig');
    }
    
    public function register()
    {
        //process user/customer registration
        UserService::registerUser($_POST);
        //redirect to login
        header('location: '.ROOT.'/auth/go/');
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
