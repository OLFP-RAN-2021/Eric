<?php


$loader = require '../vendor/autoload.php';

use App\Model\Router;
use App\Controller\FormController;
use App\Controller\HomeController;
use App\Controller\UploadController;

// dd($_SERVER);

$router = new Router();
$router->addRoute('GET', '/', [HomeController::class, 'show']);
$router->addRoute('POST', '/', [FormController::class, 'validate']);
$router->addRoute('GET', '/upload/{directory}', [UploadController::class, 'show']);
// TODO : gestion 404 et 405
$router->create();
