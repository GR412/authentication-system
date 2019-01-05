<?php

//require 'routes/change_password.php';
//require 'routes/forgot_password.php';
//require 'routes/homepage.php';
//require 'routes/login.php';
//require 'routes/logout.php';
//require 'routes/register.php';

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/register', 'AuthController:getRegisterForm')->setName('register');
$app->post('/register', 'AuthController:postRegisterForm');

$app->get('/login', 'AuthController:getLoginForm')->setName('login');
$app->post('/login', 'AuthController:postLoginForm');

