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
        
        //initialize Doctrine classloader for test.php
        require_once '../vendor/Doctrine/Common/ClassLoader.php';
        use Doctrine\Common\ClassLoader;
        $autoloader = new ClassLoader('Pizzashop', '../src');
        $autoloader->register();
        
        require_once '../src/library/helper.php';
        $helper = new \Library\Helper;
        $helper->sec_session_start();
        
        $a = array();
        print_r($a);
        end($a);
        if (empty($a)) {
            print('array empty');
        }else {
            print('END a = '.key($a));
        }
        
        $b = array('item1','item2','item3');
        print_r($b);
        end($b);
        print('END b = '.key($b));
        ?>
    </body>
</html>
