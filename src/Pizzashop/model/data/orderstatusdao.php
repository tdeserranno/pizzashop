<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Orderstatus;

/**
 * Description of orderstatusdao
 *
 * @author Thomas
 */
class OrderstatusDAO
{
    public static function getById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM orderstatus WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                $orderstatus = new Orderstatus($id, $record['description']);
                return $orderstatus;
            } else {
                throw new \Exception('orderstatus getbyid recordset empty');
            }
        } else {
            throw new \Exception('orderstatus getbyid statement could not be executed');
        }

    }
    public static function getAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM orderstatus';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    $orderstatus = new Orderstatus($record['id'], $record['description']);
                    array_push($result, $orderstatus);
                }                
                return $result;
            } else {
                throw new \Exception('orderstatus getall recordset empty');
            }
        } else {
            throw new \Exception('orderstatus getall statement could not be executed');
        }
    }
}
