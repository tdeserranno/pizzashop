<?php

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Customer;

/**
 * Description of customerdao
 *
 * @author cyber02
 */
class CustomerDAO
{
    public static function getAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM customers';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                        $customer = new Customer(
                                $record['id'],
                                $record['firstname'],
                                $record['lastname'],
                                $record['address'],
                                $record['postcode'],
                                $record['city'],
                                $record['telephone'],
                                $record['active_status'],
                                $record['username']
                                );
                        array_push($result, $customer);
                }
                return $result;
            } else {
                throw new \Exception('customer getall recordset empty');
            }
        } else {
            throw new \Exception('customer getall statement could not be executed');
        }
    }
    
    public static function getById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM customers WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                $customer = new Customer(
                        $record['id'],
                        $record['firstname'],
                        $record['lastname'],
                        $record['address'],
                        $record['postcode'],
                        $record['city'],
                        $record['telephone'],
                        $record['active_status'],
                        $record['username']
                        );
                return $customer;
            } else {
                throw new \Exception('customer getbyid recordset empty');
            }
        } else {
            throw new \Exception('customer getbyid statement could not be executed');
        }
    }
    
    public static function create($firstname, $lastname, $address, $postcode, $city, $telephone, $active_status, $username)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO customers';
        $sql .= ' (firstname, lastname, address, postcode, city, telephone, active_status, username)';
        $sql .= ' VALUES (:firstname, :lastname, :address, :postcode, :city, :telephone, :active_status, :username)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':firstname' => $firstname,
                                ':lastname' => $lastname,
                                ':address' => $address,
                                ':postcode' => $postcode,
                                ':city' => $city,
                                ':telephone' => $telephone,
                                ':active_status' => $active_status,
                                ':username' => $username))) {
                //updated                
        } else {
            throw new \Exception('customer insert statement could not be executed');
        }
    }
    
    public static function update($id, $firstname, $lastname, $address, $postcode, $city, $telephone, $active_status)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE customers SET';
        $sql .= ' firstname = :firstname,';
        $sql .= ' lastname = :lastname,';
        $sql .= ' address = :address,';
        $sql .= ' postcode = :postcode,';
        $sql .= ' city = :city,';
        $sql .= ' telephone = :telephone,';
        $sql .= ' active_status = :active_status';
        $sql .= ' WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':firstname' => $firstname,
                                ':lastname' => $lastname,
                                ':address' => $address,
                                ':postcode' => $postcode,
                                ':city' => $city,
                                ':telephone' => $telephone,
                                ':active_status' => $active_status,
                                ':id' => $id))) {
            //updating
        } else {
            throw new \Exception('customer update statement could not be executed');
        }
    }
    
    public static function delete($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'DELETE FROM customers WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
            //deleted
             } else {
            throw new \Exception('customer delete statement could not be executed');
        }
    }
    
    public static function getByUsername($username)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM customers WHERE username = :username';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':username' => $username))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                $customer = new Customer(
                        $record['id'],
                        $record['firstname'],
                        $record['lastname'],
                        $record['address'],
                        $record['postcode'],
                        $record['city'],
                        $record['telephone'],
                        $record['active_status'],
                        $record['username']
                        );
                return $customer;
            } else {
                throw new \Exception('customer getbyusername recordset empty');
            }
        } else {
            throw new \Exception('customer getbyusername statement could not be executed');
        }
    }
    
    public static function getUndeliveredCustomers()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
         $sql = 'SELECT * FROM customers WHERE id IN '
                 . '(SELECT customerid FROM orders WHERE status IN '
                 . '(SELECT id FROM orderstatus WHERE description NOT IN (\'geleverd\', \'gesloten\')) '
                 . 'AND delivery_type = \'deliver\')';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
//            if (!empty($record)) {
            $result = array();
            foreach ($recordset as $record) {
                //create object(s) and return
                $customer = new Customer(
                        $record['id'],
                        $record['firstname'],
                        $record['lastname'],
                        $record['address'],
                        $record['postcode'],
                        $record['city'],
                        $record['telephone'],
                        $record['active_status'],
                        $record['username']
                        );
                        array_push($result, $customer);
            }
                
                return $result;
//            } else {
//                throw new \Exception('customer undelivered recordset empty');
//            }
        } else {
            throw new \Exception('customer undelivered statement could not be executed');
        }
    }
}
