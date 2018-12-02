<?php

const DS = DIRECTORY_SEPARATOR;
define('ROOT', dirname(__DIR__) . DS);

//const CONFIG = ROOT . 'config' . DS;
const SRC = ROOT . 'src' . DS;
const VIEW = SRC . 'view' . DS;
const MODEL = SRC . 'model' . DS;
const CONTROLLER = SRC . 'controller' . DS;

require CONTROLLER . 'HomeController.php';
require CONTROLLER . 'CrudController.php';
require CONTROLLER . 'ErrorController.php';

$parseUrl = parse_url($_SERVER['REQUEST_URI']);
if (!$parseUrl) {
    $route = 'notFound';
    $query = null;
} else {
    $route = $parseUrl['path'];
    parse_str($_SERVER['QUERY_STRING'], $query);
}
$route = strtolower($route);
//var_dump($route);
$crud = new CrudController();
switch ($route) {
    case '/' :
    case '/home' :
        HomeController::home();
        break;
    case '/create' :
        $crud->create();
        break;
    case '/read' :
        $crud->read();
        break;
    case '/update' :
        $crud->update();
        break;
    case '/update-single' :
        if (isset($_GET['id'])) {
            $crud->updateSingle($_GET['id']);
        } else {
            $crud->update();
        }
        break;
    case '/delete' :
            $crud->delete();
        break;
    default:
        ErrorController::display('Page introuvable');
}