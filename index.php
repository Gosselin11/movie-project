<?php

include 'vendor/autoload.php';

$url = parse_url($_SERVER["REQUEST_URI"]);

$path = isset($url["path"]) ? $url["path"] : "/";

switch ($path) {
    case '/':
        echo "Home";
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
        echo "error 404";
        break;
}
