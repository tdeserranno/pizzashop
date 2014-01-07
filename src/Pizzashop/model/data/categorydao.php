<?php

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Category;

/**
 * Description of categorydao
 *
 * @author cyber02
 */
class CategoryDAO
{
    public static function getAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM categories';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    $category = new Category($record['name']);
                    array_push($result, $category);
                }
                return $result;
            } else {
                throw new \Exception('category getall recordset empty');
            }
        } else {
            throw new \Exception('category getall statement could not be executed');
        }
    }
    
    public static function getByName($categoryname)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM categories WHERE name = :categoryname';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':categoryname' => $categoryname))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                $category = new Category($record['name']);
                return $category;
            } else {
                throw new \Exception('category getbyname record empty');
            }
        } else {
            throw new \Exception('category getbyname statement could not be executed');
        }
    }
}
