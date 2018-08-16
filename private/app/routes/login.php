<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/login', function(Request $request, Response $response)
{

    $sid = session_id();

    return $this->view->render($response,
        'login.html.twig',
        [
            'css_path' => CSS_PATH,
            'landing_page' => $_SERVER["SCRIPT_NAME"],
            //'action' => 'index.php/login',
            //'initial_input_box_value' => null,
            'page_title' => 'Login App - Login',
        ]);
})->setName('login');