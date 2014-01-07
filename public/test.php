<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once '../src/Pizzashop/config/config.php';
        require_once '../src/Pizzashop/model/data/categorydao.php';
        require_once '../src/Pizzashop/model/data/articledao.php';
        require_once '../src/Pizzashop/model/entity/category.php';
        require_once '../src/Pizzashop/model/entity/article.php';
        
        $categories = Pizzashop\Model\Data\CategoryDAO::getAll();
        var_dump($categories);
        
        $pizzas = Pizzashop\Model\Data\ArticleDAO::getByCategory('pizza');
        var_dump($pizzas);
        $drank = Pizzashop\Model\Data\ArticleDAO::getByCategory('drank');
        var_dump($drank);
        
        $articles = Pizzashop\Model\Data\ArticleDAO::getAll();
        var_dump($articles);
        ?>
    </body>
</html>
