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
}
