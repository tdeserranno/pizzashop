<?php

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Data\UserDAO;
use Pizzashop\Model\Service\CustomerService;
use Framework\Exception\SecurityException;

/**
 * Description of userservice
 *
 * @author Thomas
 */
class UserService
{
    public static function serializeToSession($user)
    {
        $_SESSION['user'] = serialize($user);
    }
    
    public static function unserializeFromSession()
    {
        $user = unserialize($_SESSION['user']);
        
        return $user;
    }
    
    public static function registerUser($post)
    {
        if (isset($post)) {
            //hash password
            $hashedPassword = password_hash($post['password'], PASSWORD_DEFAULT);
            //create user
            UserService::createUser($post, $hashedPassword);
            //create customer
            CustomerService::createCustomer($post);
        }
    }
    
    public static function loginUser()
    {
        //check if not logged in already
        if (!isset($_SESSION['user'])) {
            //verify user
            $user = UserService::verifyUser($_POST['username'], $_POST['password']);
            if (is_object($user)) {
                //if login successful, create SESSION variable to store user
                UserService::serializeToSession($user);
                //redirect to home
                header('Location: '.ROOT.'/home/go');
                exit();
            } else {
                //correct POST variables were not sent
                throw new SecurityException('Password incorrect',2);
            }
        } else {
            throw new SecurityException('Already logged in');
        }
    }
    
    public static function verifyUser($username, $password)
    {
        if (isset($username,$password) && !empty($username) && !empty($password)) {
            //hash POSTed password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            //retrieve user and password from DB
            $user = UserDAO::getUser($username);
            $userPassword = UserDAO::getPassword($username);
            //verify password
            if (password_verify($password, $userPassword)) {
                return $user;
            } else {
                throw new SecurityException('password incorrect',2);
            }
        }
    }
    
    public static function logoutUser()
    {
        if (isset($_SESSION['user'])) {
            //unset SESSION vars
            unset($_SESSION['user']);
            //redirect to home
            header('Location: '.ROOT.'/home/go/');
            exit();
        } else {
            throw new SecurityException('Cannot log out a user that isn\'t logged in');
        }
    }
    
    public static function createUser($post, $hashedPassword)
    {
        if (isset($post,$hashedPassword) && !empty($hashedPassword)) {
            UserDAO::create($post['username'], $hashedPassword, $post['email']);
        }
    }
    
    public static function deleteUser($username)
    {
        if (isset($username) && !empty($username)) {
            UserDAO::delete($username);
        }
    }
}
