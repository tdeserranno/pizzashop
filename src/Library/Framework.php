<?php
namespace Library;
use Doctrine\Common\ClassLoader;

/**
 * Description of AbstractMVCFramework
 * Instanciates a Doctrine classloader for the Library, needed to load
 * the framework classes
 *
 * @author cyber02
 */
abstract class AbstractMVCFramework
{
    private $frameworkLoader;
    
    function __construct()
    {
        //initialize Doctrine classloader for framework
        require_once '../vendor/Doctrine/Common/ClassLoader.php';
        $this->frameworkLoader = new ClassLoader('Library', '../src');
        $this->frameworkLoader->register();
    }
}
