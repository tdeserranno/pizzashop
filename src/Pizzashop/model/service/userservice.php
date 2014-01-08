<?php

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\UserDAO;
use Library\Exception\AuthenticationException;

/**
 * Description of userservice
 *
 * @author Thomas
 */
class UserService
{
    public static function registerUser()
    {
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
    }
    
    public static function loginUser()
    {
        //check if not logged in already
        if (!isset($_SESSION['user'])) {
            //verify user
            $user = UserService::verifyUser($_POST['username'], $_POST['password']);
            if (is_object($user)) {
                //if login successful, create SESSION variable to store username and usertype
                $_SESSION['user']['username'] = $user->getUsername();
                $_SESSION['user']['admin'] = $user->getAdmin();
                //if set redirect to requested page, otherwise redirect to home
                $redirect = isset($_SESSION['prev_req_page']) ? $_SESSION['prev_req_page'] : '/pizzashop/home/go/';
                header('Location: '. $redirect);
                exit();
            } else {
                //correct POST variables were not sent
                throw new AuthenticationException('Password incorrect',2);
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
            return $user;
        } else {
            throw new AuthenticationException('password incorrect',2);
        }
    }
    
    public static function logoutUser()
    {
        if (isset($_SESSION['user'])) {
            //unset SESSION vars
            unset($_SESSION['user']);
            unset($_SESSION['prev_req_page']);
            //redirect to home
            header('Location: /pizzashop/home/go/');
            exit();
        } else {
            throw new \Exception('Cannot log out a user that isn\'t logged in');
        }
    }
}
