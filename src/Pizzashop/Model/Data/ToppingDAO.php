<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Topping;

/**
 * Description of toppingdao
 *
 * @author cyber02
 */
class ToppingDAO
{
    public static function getById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM toppings WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                $topping = new Topping(
                            $record['id'],
                            $record['name'],
                            $record['price']
                            );
                return $topping;
            } else {
                throw new \Exception('topping getbyid recordset empty');
            }
        } else {
            throw new \Exception('topping getbyid statement could not be executed');
        }

    }
    public static function getAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM toppings';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    $topping = new Topping(
                            $record['id'],
                            $record['name'],
                            $record['price']
                            );
                    array_push($result, $topping);
                }                
                return $result;
            } else {
                throw new \Exception('topping getall recordset empty');
            }
        } else {
            throw new \Exception('topping getall statement could not be executed');
        }
    }
            
    public static function create($name, $price)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO toppings';
        $sql .= ' (name, price)';
        $sql .= ' VALUES (:name, :price)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':name' => $name,
                                ':price' => $price))) {
                //topping added
        } else {
            throw new \Exception('topping insert statement could not be executed');
        }
    }
    
    public static function update($id, $name, $price)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE toppings SET';
        $sql .= ' name = :name,';
        $sql .= ' price = :price';
        $sql .= ' WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':name' => $name,
                                ':price' => $price,
                                ':id' => $id))) {
            //topping updated
        } else {
            throw new \Exception('topping update statement could not be executed');
        }
    }
    
    public static function delete($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'DELETE FROM toppings WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
            //deleted
             } else {
            throw new \Exception('topping delete statement could not be executed');
        }
    }
}
