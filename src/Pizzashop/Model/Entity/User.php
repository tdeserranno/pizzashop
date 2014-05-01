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
    private $admin;

    function __construct($username, $admin)
    {
        $this->username = $username;
        $this->admin = $admin;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
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
