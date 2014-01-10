<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizzashop\Model\Data;
use Pizzashop\Model\Entity\Article;
use Pizzashop\Model\Service\CategoryService;

/**
 * Description of articledao
 *
 * @author cyber02
 */
class ArticleDAO
{
    public static function getAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM articles';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create category object
                    $category = CategoryService::getCategory($record['category']);
                    //create article object
                    $article = new Article(
                            $record['id'],
                            $record['name'],
                            $record['description'], 
                            $record['image'], 
                            $record['price'], 
                            $record['promo_status'], 
                            $record['promo_price'], 
                            $category);
                    array_push($result, $article);
                }
                return $result;
            } else {
                throw new \Exception('article getall recordset empty');
            }
        } else {
            throw new \Exception('article getall statement could not be executed');
        }
    }
    
    public static function getById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM articles WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                //create category object
                $category = CategoryService::getCategory($record['category']);
                //create article object
                $article = new Article(
                            $record['id'],
                            $record['name'],
                            $record['description'],
                            $record['image'],
                            $record['price'],
                            $record['promo_status'],
                            $record['promo_price'],
                            $category
                            );
                return $article;
            } else {
                throw new \Exception('article getbyid recordset empty');
            }
        } else {
            throw new \Exception('article getbyid statement could not be executed');
        }
    }
    
    public static function getByCategory($category)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM articles WHERE category = :categoryname';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':categoryname' => $category))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create category object
                    $category = CategoryService::getCategory($record['category']);
                    //create article object
                    $article = new Article(
                            $record['id'],
                            $record['name'],
                            $record['description'],
                            $record['image'],
                            $record['price'],
                            $record['promo_status'],
                            $record['promo_price'],
                            $category
                            );
                    array_push($result, $article);
                }
                return $result;
            } else {
                throw new \Exception('article getbycategory recordset empty');
            }
        } else {
            throw new \Exception('article getbycategory statement could not be executed');
        }
    }
    
    public static function update($id, $name, $description, $image, $price, $promo_status, $promo_price, $category)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE articles SET';
        $sql .= ' name = :name,';
        $sql .= ' description = :description,';
        $sql .= ' image = :image,';
        $sql .= ' price = :price,';
        $sql .= ' promo_status = :promo_status,';
        $sql .= ' promo_price = :promo_price,';
        $sql .= ' category = :category';
        $sql .= ' WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':name' => $name,
                                ':description' => $description,
                                ':image' => $image,
                                ':price' => $price,
                                ':promo_status' => $promo_status,
                                ':promo_price' => $promo_price,
                                ':category' => $category,
                                ':id' => $id))) {
            //article updated
        } else {
            throw new \Exception('article update statement could not be executed');
        }
    }
    
    public static function create($name, $description, $image, $price, $promo_status, $promo_price, $category)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO articles';
        $sql .= ' (name, description, image, price, promo_status, promo_price, category)';
        $sql .= ' VALUES (:name, :description, :image, :price, :promo_status, :promo_price, :category)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':name' => $name,
                                ':description' => $description,
                                ':image' => $image,
                                ':price' => $price,
                                ':promo_status' => $promo_status,
                                ':promo_price' => $promo_price,
                                ':category' => $category))) {
                //updated                
        } else {
            throw new \Exception('article insert statement could not be executed');
        }
    }
    
    public static function delete($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'DELETE FROM articles WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
            //deleted
             } else {
            throw new \Exception('article delete statement could not be executed');
        }
    }
}
