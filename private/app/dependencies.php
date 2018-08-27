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

$container['validate_sanitize'] = function ($container)
{
    $class_path = $container->get('settings')['class_path'];
    require $class_path . 'ValidateSanitize.php';
    $validator = new Validate_Sanitize();
    return $validator;
};

$container['hash_password'] = function($container)
{
    $class_path = $container->get('settings')['class_path'];
    require $class_path . 'HashPassword.php';
    $hash = new HashPassword();
    return $hash;
};

$container['model'] = function($container)
{
    $class_path = $container->get('settings')['class_path'];
    require $class_path . 'Model.php';
    $model = new Model();
    return $model;
};

$container['sql_wrapper'] = function ($container)
{
    $class_path = $container->get('settings')['class_path'];
    require $class_path . 'SQLWrapper.php';
    $sql_wrapper = new SQLWrapper();
    return $sql_wrapper;
};

$container['sql_queries'] = function ($container)
{
    $class_path = $container->get('settings')['class_path'];
    require $class_path . 'SQLQueries.php';
    $sql_queries = new SQLQueries();
    return $sql_queries;
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

