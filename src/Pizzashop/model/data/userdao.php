<?php

namespace Pizzashop\Model\Data;
use Library\Exception\AuthenticationException;
use Pizzashop\Model\Entity\User;

/**
 * Description of userdao
 *
 * @author Thomas
 */
class UserDAO
{
    public static function create($username, $password, $email,$firstname, $lastname, $address, $postcode, $city, $telephone)
    {
        //create DB connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare statement
        $sql = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email)';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':username' => $username, ':password' => $password, ':email' => $email));
        unset($db);
    }
    
    public static function getUser($username)
    {
        //create DB connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare statement
        $sql = 'SELECT * FROM users WHERE username = :username';    
        $stmt = $db->prepare($sql);
//        var_dump($stmt);
        //test if statement can be executed
        if ($stmt->execute(array(':username' => $username))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create user object and return it
                $user = new User($record['username'], $record['password'], $record['admin']);
                return $user;
            } else {
                //no matching record
                throw new AuthenticationException('no matching user found',2);
            }
        } else {
            //statement could not be executed
            throw new \Exception('statement could not be executed');
        }
    }
}
