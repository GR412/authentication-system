<?php

//Development: change to - on, on
ini_set('display_errors', 'On');
ini_set('html_errors', 'On');
ini_set('xdebug.trace_output_name', 'private.%t');

define('DIRSEP', DIRECTORY_SEPARATOR);

$url_root = $css_path = $_SERVER['SCRIPT_NAME'];
$url_root = implode('/', explode('/', $url_root, -1));
$css_path = $url_root . '/css/styles.css';
define('CSS_PATH', $css_path);

//Development: change to - true, true, development, true
$settings = [
    "settings" => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'mode' => 'development',
        'debug' => true,
        'class_path' => __DIR__ . '/src/',
        'view' => [
            'template_path' => __DIR__ . '/templates/',
            'twig' => [
                'cache' => __DIR__ . '/cache/twig',
                'auto_reload' => true,
            ]],
        'pdo' => [
            'rdbms' => 'mysql',
            'host' => 'localhost',
            'db_name' => 'session_db',
            'port' => '3306',
            'user_name' => 'session_user',
            'user_password' => 'session_user_pass',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'options' => [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => true,
            ],
        ]
    ],
];

return $settings;