<?php

namespace Pizzashop\Model\Entity;

/**
 * Description of user
 *
 * @author Thomas
 */
class User
{
    private $username;
    private $hashedPassword;
    private $admin;
    
    function __construct($username, $hashedPassword, $admin)
    {
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
        $this->admin = $admin;
    }
    
    public function getUsername()
    {
        return $this->username;
    }

    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setHashedPassword($hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }
    
    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }
}
