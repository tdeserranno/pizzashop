<?php
namespace Library;
use Doctrine\Common\ClassLoader;
use Twig_Autoloader;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Library\Helper;

/**
 * Description of Application
 * Application class that instanciates the necessary Doctrine autoloader,
 * Twig environment and loads Helper and Session class and config file
 * for the application.
 *
 * @author cyber02
 */
class Application extends AbstractMVCFramework
{
    protected $appName;
    protected $appLoader;
    protected $envLoader;
    public $environment;
    public $helper;
    protected $dispatcher;
            
    function __construct($appName)
    {
        //call framework constructor
        parent::__construct();
        $this->appName = $appName;
        //initialize Doctrine classloader for application
        $this->appLoader = new ClassLoader($appName, '../src');
        $this->appLoader->register();
        //Initialize Twig environment
        require_once '../vendor/Twig/Autoloader.php';
        Twig_Autoloader::register();
        $twigLoader = new Twig_Loader_Filesystem('../src/'.$appName.'/view');
        $this->environment = new Twig_Environment($twigLoader);
        //load application config file
        require_once '../src/'.$appName.'/config/config.php';
        //load helper functions
        $this->helper = new Helper;
        $this->dispatcher = new Dispatcher($this);
    }
    
    public function getAppName()
    {
        return $this->appName;
    }

    public function getAppLoader()
    {
        return $this->appLoader;
    }

    public function getEnvLoader()
    {
        return $this->envLoader;
    }

    public function getDispatcher()
    {
        return $this->dispatcher;
    }
    public function getPageRequested()
    {
        return $this->pageRequested;
    }

    public function setPageRequested($pageRequested)
    {
        $this->pageRequested = $pageRequested;
    }
}
