<?php

use Respect\Validation\Validator as v;

session_start(); //create a blank session file the person currently on the site

require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/app/settings.php';

$container = new \Slim\Container($settings);

require __DIR__ . '/app/dependencies.php';

$app = new \Slim\App($container);

/*$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ]
]);*/

//$container = $app->getContainer();

/*$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/app/templates/', [
            'debug' => true,
            'cache' => false //__DIR__ . '/cache/twig'
        ]);

    // Instantiate and add Slim specific extension
    $view->addExtension(new Slim\Views\TwigExtension($container->router, $container->request->getUri()));

    return $view;
};*/

/*$container['validator'] = function ($container)
{
    return new App\src\ValidateSanitize;
};

$container['HomeController'] = function ($container)
{
    return new App\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container)
{
    return new App\Controllers\AuthController($container);
};*/

$app->add(new \App\Middleware\ValidationErrorsMW($container));
$app->add(new \App\Middleware\OldFormDataMW($container));

v::with('App\\src\\');

require __DIR__ . '/app/routes.php';


$app->run();



