<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Entity;

/**
 * Description of orderstatus
 *
 * @author Thomas
 */
class Orderstatus
{
    private $id;
    private $description;
    
    function __construct($id, $description)
    {
        $this->id = $id;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
