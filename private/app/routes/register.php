<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/register', function(Request $request, Response $response)
{
    return $this->view->render($response, 'register.html.twig',
        [
            'css_path' => CSS_PATH,
            'landing_page' => $_SERVER["SCRIPT_NAME"],
            //'action_register' =>  './display',
            'page_title' => 'Login App - Register',
        ]);
})->setName('register');

$app->post('/register', function(Request $request, Response $response)
{
    $arr_tainted_params = $request->getParsedBody();

    $sanitizer_validator = $this->get('validate_sanitize');
    $password_hasher = $this->get('hash_password');

    $tainted_email = $arr_tainted_params['email'];
    $tainted_username = $arr_tainted_params['username'];
    $tainted_password = $arr_tainted_params['password'];

    $model = $this->get('model');
    $sql_wrapper = $this->get('sql_wrapper');
    $sql_queries = $this->get('sql_queries');
    $db_handle = $this->get('dbase');

    $cleaned_email = $sanitizer_validator->sanitize_input($tainted_email, FILTER_SANITIZE_EMAIL);
    $cleaned_username = $sanitizer_validator->sanitize_input($tainted_username, FILTER_SANITIZE_STRING);
    $cleaned_password = $sanitizer_validator->sanitize_input($tainted_password, FILTER_SANITIZE_EMAIL);

    $sanitizer_validator->validate_email($cleaned_email);
    $sanitizer_validator->validate_username($cleaned_username);
    $sanitizer_validator->validate_password($cleaned_password);

    $model->set_user_values($cleaned_username, $cleaned_email, $cleaned_password);
    $model->set_sql_wrapper($sql_wrapper);
    $model->set_sql_queries($sql_queries);
    $model->set_db_handle($db_handle);

    if ($sanitizer_validator->get_validate_messages('email_error') == ' ' && $sanitizer_validator->get_validate_messages('username_error') == ' ' && $sanitizer_validator->get_validate_messages('password_error') == ' ')
    {
        $model->store_user_details();

        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $cleaned_username;
    }

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
        return $this->view->render($response, 'display_user.html.twig',
            [
                'css_path' => CSS_PATH,
                'landing_page' => $_SERVER["SCRIPT_NAME"],
                'page_title' => 'Login App - Display',
                'email' => $cleaned_email,
                'username' => $cleaned_username,
                'hashed_password' =>  $cleaned_password,
            ]);
    }

    else
    {
        //return $response->withRedirect($this->router->pathFor('home'));
        return $this->view->render($response, 'register.html.twig',
            [
                'css_path' => CSS_PATH,
                'landing_page' => $_SERVER["SCRIPT_NAME"],
                'action_register' =>  './display',
                'page_title' => 'Login App - Register',
                'email_error' => $sanitizer_validator->get_validate_messages('email_error'),
                'username_error' => $sanitizer_validator->get_validate_messages('username_error'),
                'password_error' => $sanitizer_validator->get_validate_messages('password_error'),
            ]);
    }
});


