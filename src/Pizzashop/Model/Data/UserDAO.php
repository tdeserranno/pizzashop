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
    public static function create($username, $hashedpassword, $email)
    {
        //create DB connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare statement
        $sql = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email)';
        $stmt = $db->prepare($sql);
        if ($stmt->execute(array(':username' => $username,
                                ':password' => $hashedpassword,
                                ':email' => $email))) {
            //inserting
        } else {
            throw new \Exception ('insert user statement could not be executed');
        }
        unset($db);
    }
    
    public static function delete($username)
    {
        //create DB connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare statement
        $sql = 'DELETE FROM users WHERE username = :username';
        $stmt = $db->prepare($sql);
        if ($stmt->execute(array(':username' => $username))) {
            //deleting
        } else {
            throw new \Exception ('delete user statement could not be executed');
        }
    }
    
    public static function getUser($username)
    {
        //create DB connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare statement
        $sql = 'SELECT * FROM users WHERE username = :username';    
        $stmt = $db->prepare($sql);
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
            throw new \Exception('getuser statement could not be executed');
        }
    }
}
