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
    
    function __construct($username, $hashedPassword)
    {
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
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
}
