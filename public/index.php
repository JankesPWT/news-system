<?php
namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\NewsController;
use App\Controllers\AuthorController;
use App\Core\Router;

$router = new Router();

$router->get('/', NewsController::class . '::home');

$router->get('/news/create', NewsController::class . '::create');
$router->post('/news/create', NewsController::class . '::add');

$router->get('/news/edit/{id}', NewsController::class . '::edit');
$router->post('/news/edit/{id}', NewsController::class . '::update');

$router->get('/news/delete/{id}', NewsController::class . '::delete');

$router->get('/news', NewsController::class . '::index');
$router->get('/news/{id}', NewsController::class . '::show');

$router->get('/top', AuthorController::class . '::top');

$router->addNotFoundHandler(function () {
    $title = 'Not Found';
    require_once __DIR__ . '/../Views/404.php';
});

$router->run();