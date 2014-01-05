<?php

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\UserDAO;
use Library\Exception\AuthenticationException;
use Pizzashop\Exception\ValidationException;
use Pizzashop\Model\Service\SignupValidator;
use Pizzashop\Model\Service\LoginValidator;

/**
 * Description of userservice
 *
 * @author Thomas
 */
class UserService
{
    public static function registerUser()
    {
        //validate signup form
        $valid = new SignupValidator();
        if ($valid->validate($_POST)) {
            //if valid,
            //hash password
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            //create user
            UserDAO::create($_POST['username'],
                            $hashedPassword,
                            $_POST['email'],
                            $_POST['firstname'],
                            $_POST['lastname'],
                            $_POST['address'],
                            $_POST['postcode'],
                            $_POST['city'],
                            $_POST['telephone']);
             //redirect to login
            header('location: /pizzashop/auth/go');
            exit();
        } else {
            //store errors in session and throw exception ?
        }
    }
    
    public static function loginUser()
    {
        //check if not logged in already
        if (!isset($_SESSION['user'])) {
            //validate login
            $valid = new LoginValidator();
            if ($valid->validate($_POST) == true) {
                var_dump($valid->validate($_POST));
                //verify user
                if (UserService::verifyUser($_POST['username'], $_POST['password'])) {
                    //if login successful, create SESSION variables
                    //if set redirect to requested page, otherwise redirect to home
                    $_SESSION['user'] = $_POST['username'];
                    $redirect = isset($_SESSION['prev_req_page']) ? $_SESSION['prev_req_page'] : '/pizzashop/home/go/';
                    header('Location: '. $redirect);
                    exit();
                } 
            } else {
                //correct POST variables were not sent
                throw new ValidationException('login',$errors);
            }
        } else {
            throw new \Exception('Already logged in');
        }
    }
    
    public static function verifyUser($username, $password)
    {
        //hash POSTed password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        //retrieve user from DB
        $user = UserDAO::getUser($username);
        //verify password
        if (password_verify($password, $user->getHashedPassword())) {
            return true;
        } else {
            throw new AuthenticationException('password incorrect',2);
        }
    }
    
    public static function logoutUser()
    {
        if (isset($_SESSION['user'])) {
            //unset SESSION var
            unset($_SESSION['user']);
            //redirect to home
            header('Location: /pizzashop/home/go/');
            exit();
        } else {
            throw new \Exception('Cannot log out a user that isn\'t logged in');
        }
    }
}
