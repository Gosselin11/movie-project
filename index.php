<?php
//import de de l'autoload
include 'vendor/autoload.php';
include 'env.php';

//récupération de l'url
$url = parse_url($_SERVER["REQUEST_URI"]);
$path = isset($url["path"]) ? $url["path"] : "/";

//Import des classes
use App\Controller\HomeController;
use App\Controller\ErrorController;
//importer avec use CategoryController

//Instance des controllers
$homeController = new HomeController();
$errorController = new ErrorController();
//instancier CategoryController
//router
switch ($path) {
    case '/':
        $homeController->index();
        break;
    case '/category/add':
        //appeler la méthode addCategory (CategoryController)
        break;
    case '/login':
        echo "login";
        break;
    case '/logout':
        echo "deconnexion";
        break;
    case '/register':
        echo "inscription";
        break;
    default:
        $errorController->error404();
        break;
}
