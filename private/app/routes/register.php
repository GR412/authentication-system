<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/register', function(Request $request, Response $response)
{

    //$sid = session_id();

    return $this->view->render($response,
        'register.html.twig',
        [
            'css_path' => CSS_PATH,
            'landing_page' => $_SERVER["SCRIPT_NAME"],
            'action_register' => './display',
            //'initial_input_box_value' => null,
            'page_title' => 'Login App - Register',
        ]);
})->setName('register');