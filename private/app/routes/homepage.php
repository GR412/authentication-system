<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', function(Request $request, Response $response)
{
    return $this->view->render($response, 'homepage.html.twig',
        [
            'css_path' => CSS_PATH,
            'landing_page' => $_SERVER["SCRIPT_NAME"],
            'register_form' => 'index.php/register',
            'login_form' => 'index.php/login',
            'page_title' => 'Login App - Homepage',
            //'sid' => $sid,
        ]);

})->setName('home');
