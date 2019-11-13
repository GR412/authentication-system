<?php

namespace App\Controllers;

class AuthController extends Controller
{
    public function getRegisterForm($request, $response) //this function simply displays the register from when the sign up button is pressed from the homepage
    {
        /*if (isset($_SESSION['validation_errors']))
        {
            $this->container->view->getEnvironment()->addGlobal('validation_errors', $_SESSION['validation_errors']);
            unset($_SESSION['validation_errors']);
        }*/

        return $this->container->view->render($response, 'register.html.twig',
            [
                'css_path' => CSS_PATH,
                'landing_page' => $_SERVER["SCRIPT_NAME"], //A link to the app's homepage, for faster navigation
                'register_action' =>  './register', //invokes the register code that is a post request to process the user data when the create button is pressed
                'page_title' => 'Login App - Register', //sets the title of the register form page
            ]);
    }

    public function postRegisterForm($request, $response) //this function processes the users request when the register button has been pressed
    {
        $arr_tainted_params = $request->getParsedBody(); //create an array that contains the user input from the register form

        $tainted_email = $arr_tainted_params['email']; //get each tainted entry from the array and give it a variable
        $tainted_username = $arr_tainted_params['username'];
        $tainted_password = $arr_tainted_params['password'];
        $tainted_password_confirm = $arr_tainted_params['password_confirm'];

        //$model = $this->container->Model; //create objects of various classes to access methods and to pass to the model class
        $sanitizer_validator = $this->container->ValidateSanitize;
        $sql_wrapper = $this->container->SQLWrapper;
        $sql_queries = $this->container->SQLQueries;
        $db_handle = $this->container->get('dbase');

        $cleaned_email = $sanitizer_validator->sanitize_input($tainted_email, FILTER_SANITIZE_EMAIL); //sanitise each tainted user input to make it 'clean' and assign to a new variable ready to be inserted into the database
        $cleaned_username = $sanitizer_validator->sanitize_input($tainted_username, FILTER_SANITIZE_STRING);
        $cleaned_password = $sanitizer_validator->sanitize_input($tainted_password, FILTER_SANITIZE_STRING);
        $cleaned_password_confirm = $sanitizer_validator->sanitize_input($tainted_password_confirm, FILTER_SANITIZE_STRING);

        $hashed_cleaned_password = password_hash($cleaned_password, PASSWORD_DEFAULT); //ensure the 'clean' user password is hashed before inserting inside the database

        //$sanitizer_validator->check_email_exists($cleaned_email);
        $sanitizer_validator->validate_email($cleaned_email);
        $sanitizer_validator->validate_username($cleaned_username);
        $sanitizer_validator->validate_password($cleaned_password);
        $sanitizer_validator->validate_password_confirm($cleaned_password_confirm);


        if ($sanitizer_validator->get_validate_messages('email_error') == ' ' && $sanitizer_validator->get_validate_messages('username_error') == ' '
            && $sanitizer_validator->get_validate_messages('password_error') == ' ' && $sanitizer_validator->check_passwords_match($cleaned_password, $cleaned_password_confirm ) == true
            && $sanitizer_validator->check_email_exists($cleaned_email) == false)
        {
            //$model->set_user_values($cleaned_email, $cleaned_username, $hashed_cleaned_password);//provides the model with the cleaned and hashed user details
            //$model->set_sql_wrapper($sql_wrapper); //provides the model with the database management class
            //$model->set_sql_queries($sql_queries); //provides the model with the sql query statements
            //$model->set_db_handle($db_handle); //provides the model with the database details such as connection information

            //$model->register_user(); //inserts the email, username and password into the database

           // $sanitizer_validator->set_user_values($cleaned_email);//THIS LINE IS THE ISSUE

            //$sql_wrapper->set_db_handle($db_handle); //sets the database details in the sql wrapper class
            //$sql_wrapper->set_sql_queries($sql_queries);

            $sanitizer_validator->set_sql_wrapper($sql_wrapper);
            $sanitizer_validator->set_sql_queries($sql_queries); //provides the model with the sql query statements
            $sanitizer_validator->set_db_handle($db_handle); //provides the model with the database details such as connection information


            //$details_taken = array('email_taken_message' => ' ', 'username_taken_message' => ' ');

            //if ($sql_wrapper->email_exists($cleaned_email) === true || $sql_wrapper->username_exists($cleaned_username) == true)
            //{
                /*if ($sql_wrapper->email_exists($cleaned_email) === true)
                {
                    $sanitizer_validator->display_email_exists_message();
                    return $response->withRedirect($this->container->router->pathFor('register'));
                }*/
            //}

                //else
                //{
                    $sql_wrapper->store_details($cleaned_email, $cleaned_username, $hashed_cleaned_password);
                    return $response->withRedirect($this->container->router->pathFor('login'));
                //}
        }

        else
        {
            $sanitizer_validator->display_validate_messages();
            //$sanitizer_validator->display_email_check_messages();
            return $response->withRedirect($this->container->router->pathFor('register'));
        }
    }

    public function getLoginForm($request, $response) //this function simply displays the register from when the sign up button is pressed from the homepage
    {
        return $this->container->view->render($response, 'login.html.twig',
            [
                //'css_path' => CSS_PATH,
                'landing_page' => $_SERVER["SCRIPT_NAME"],
                //'action_register' =>  './display',
                'page_title' => 'Login App - Register',
            ]);
    }

    public function postLoginForm($request, $response)
    {
        $arr_tainted_params = $request->getParsedBody(); //create an array that contains the user input from the form

        $tainted_username = $arr_tainted_params['username']; //get each entry from the array and give it a variable
        $tainted_password = $arr_tainted_params['password'];

        //$tainted_username = trim($_GET["username"]);
        //$tainted_password = trim($_GET["password"]);

        $model = $this->container->Model; //create objects of various classes to access methods and to pass to the model class
        $sql_wrapper = $this->container->SQLWrapper;
        $sql_queries = $this->container->SQLQueries;
        $db_handle = $this->container->get('dbase');
        $sanitizer_validator = $this->container->ValidateSanitize;

        $cleaned_username = $sanitizer_validator->sanitize_input($tainted_username, FILTER_SANITIZE_STRING); //sanitise each user input to make it 'clean' and assign to a new variable ready to be inserted into the database
        $cleaned_password = $sanitizer_validator->sanitize_input($tainted_password, FILTER_SANITIZE_STRING);

        $sanitizer_validator->validate_username($cleaned_username);
        $sanitizer_validator->validate_password($cleaned_password);

        if ($sanitizer_validator->get_validate_messages('username_error') == ' ' && $sanitizer_validator->get_validate_messages('password_error') == ' ')
        {
            /*$model->set_user_values(' ', $cleaned_username, $cleaned_password);
            $model->set_sql_wrapper($sql_wrapper);
            $model->set_sql_queries($sql_queries);
            $model->set_db_handle($db_handle);

            $model->authenticate_user();*/

            $sql_wrapper->set_db_handle($db_handle);
            $sql_wrapper->set_sql_queries($sql_queries);

            $sql_wrapper->attempt_authentication($cleaned_username, $cleaned_password);

            //$_SESSION["loggedin"] = false;
            //$_SESSION["username"] = $cleaned_username;

            $arr_storage_result_message = '';

            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
            {
                return $this->container->view->render($response,
                    'display_user.html.twig',
                    [
                        'css_path' => CSS_PATH,
                        'landing_page' => $_SERVER["SCRIPT_NAME"],
                        //'action_register' => 'index.php/register',
                        //'initial_input_box_value' => null,
                        'page_title' => 'Login App - Display',
                        'username' => $cleaned_username,
                        'hashed_password' => $cleaned_password,
                    ]);

            }

            else
            {
                if ($sql_wrapper->username_exists($cleaned_username) === false)
                {
                    $username_check_message = array
                    (
                        'message' => 'This username does not exist'
                    );
                }

                else
                {
                    $username_check_message = array
                    (
                        'message' => ' '
                    );
                }

                $_SESSION['validation_errors'] = $username_check_message;
                return $response->withRedirect($this->container->router->pathFor('login'));
                //echo $cleaned_username;
                //echo $cleaned_password;
            }
        }

        else
        {
            $sanitizer_validator->display_validate_messages();

            return $response->withRedirect($this->container->router->pathFor('login'));
        }
    }
}