<?php
/** Index.php essentially functions as a front controller,
 * instanciating the application class and running the application
 */

// Initialize application
require_once '../src/Library/framework.php';
require_once '../src/Library/application.php';
use Library\Application;
use Library\Helper;
use Library\Exception\AuthenticationException;
use Library\Exception\DispatcherException;

//appname must be identical to the application folder in src folder(case sensitive)
$app = new Application('Pizzashop');

//start secure session
$app->helper->sec_session_start();
//add SESSION as Twig global to allow direct access from any twig template
$app->environment->addGlobal('session', $_SESSION);

try {
    //check if access is allowed to requested page(controller)
    $app->helper->check_access_allowed();
    //dispatch requested controller
    $app->getDispatcher()->run();
} catch (AuthenticationException $ex) {
    switch ($ex->getCode()) {
        //user needs to be logged in to view requested controller
        case '1':
            //before redirecting to login page store requested page in SESSION to use
            //for redirecting after login
            $_SESSION['prev_req_page'] = $_SERVER['REQUEST_URI'];
            header('Location: /pizzashop/auth/go');
            exit();
            break;
        //authentication errors on login page
        case '2':
            print($app->environment->render('login.twig', array('exception' => $ex)));
            break;
        default: 
            print($app->environment->render('error.twig', array('exception' => $ex)));
            break;
    }
} catch (DispatcherException $ex) {
    print($app->environment->render('error.twig', array('exception' => $ex)));
} catch (Exception $ex) {
    print($app->environment->render('error.twig', array('exception' => $ex)));
}
