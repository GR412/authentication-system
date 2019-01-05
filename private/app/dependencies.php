<?php

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(
        $container['settings']['view']['template_path'],
        $container['settings']['view']['twig'],
        [
            'debug' => true // This line should enable debug mode
        ]
    );

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    // This line should allow the use of {{ dump() }} debugging in Twig
    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};

$container['dbase'] = function ($container)
{
    $db_conf = $container['settings']['pdo'];
    $host_name = $db_conf['rdbms'] . ':host=' . $db_conf['host'];
    $port_number = ';port=' . '3306';
    $user_database = ';dbname=' . $db_conf['db_name'];
    $host_details = $host_name . $port_number . $user_database;
    $user_name = $db_conf['user_name'];
    $user_password = $db_conf['user_password'];
    $pdo_attributes = $db_conf['options'];
    $obj_pdo = null;
    try
    {
        $obj_pdo = new PDO($host_details, $user_name, $user_password, $pdo_attributes);
    }
    catch (PDOException $exception_object)
    {
        trigger_error('error connecting to  database');
    }
    return $obj_pdo;
};

$container['HomeController'] = function ($container)
{
    return new App\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container)
{
    return new App\Controllers\AuthController($container);
};

$container['ValidateSanitize'] = function ($container)
{
    return new App\src\ValidateSanitize($container);
};

$container['Model'] = function($container)
{
    return new App\src\Model($container);
};

$container['SQLWrapper'] = function($container)
{
    return new App\src\SQLWrapper($container);
};

$container['SQLQueries'] = function($container)
{
    return new App\src\SQLQueries($container);
};

$container['Authenticate'] = function($container)
{
    return new App\src\Authenticate($container);
};



