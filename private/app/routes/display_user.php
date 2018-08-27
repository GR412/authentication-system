<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post('/display', function(Request $request, Response $response) use ($app)
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

    $cleaned_email = $sanitizer_validator->validate_email($tainted_email);
    $cleaned_username = $sanitizer_validator->validate_username($tainted_username);
    $cleaned_password  = $sanitizer_validator->validate_password($tainted_password);
    $hashed_cleaned_password = $password_hasher->hash_password($cleaned_password);

    $model->set_user_values($cleaned_username, $cleaned_email, $hashed_cleaned_password);
    $model->set_sql_wrapper($sql_wrapper);
    $model->set_sql_queries($sql_queries);
    $model->set_db_handle($db_handle);
    $model->store_user_details();

    $arr_storage_result_message = '';

    return $this->view->render($response,
        'display_user.html.twig',
        [
            'css_path' => CSS_PATH,
            'landing_page' => $_SERVER["SCRIPT_NAME"],
            //'action_register' => 'index.php/register',
            //'initial_input_box_value' => null,
            'page_title' => 'Login App - Display',
            'email' =>  $cleaned_email,
            'username' => $cleaned_username,
            'hashed_password' => $hashed_cleaned_password,
        ]);
});