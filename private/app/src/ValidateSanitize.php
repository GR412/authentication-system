<?php

namespace App\src;

//please note that $_p represents an incoming parameter

class ValidateSanitize
{
    private $validation_errors = array('email_error' => ' ', 'username_error' => ' ', 'password_error' => ' ', 'password_confirm_error' => ' ', 'email_taken_error' => ' ', 'username_taken_error' => ' ');
    private $sql_wrapper, $sql_queries, $db_handle;

    public function __construct()
    {
        $this->sql_wrapper = null;
        $this->sql_queries = null;
        $this->db_handle = null;
    }

    public function __destruct(){ }

    public function set_sql_wrapper ($p_sql_wrapper) //assigns the incoming sql wrapper object to the models sql field variable
    {
        $this->sql_wrapper = $p_sql_wrapper;
    }

    public function set_sql_queries ($p_sql_queries) //assigns the incoming sql queries object to the models sql queries field variable
    {
        $this->sql_queries = $p_sql_queries;
    }

    public function set_db_handle ($p_db_handle) //assigns the incoming database handle object to the models database handle field variable
    {
        $this->db_handle = $p_db_handle;
    }

    public function sanitize_input($p_input, $p_filter_type) //takes in a string to sanitise and a filter type depending on the string to sanitise
    {
        $sanitized_output = ' ';

        if (!empty($p_input)) //if the string provided isn't empty
            $sanitized_output = filter_var($p_input, $p_filter_type, FILTER_FLAG_NO_ENCODE_QUOTES); //use php's filter_var function to sanitise the string with the given filter type

        return $sanitized_output; //return the newly sanitised string
    }

    public function validate_email($p_email_to_validate)
    {
        if ($p_email_to_validate == " ")
            $this->validation_errors['email_error'] = 'An email is required'; //if the user leaves the field blank

        elseif(strlen($p_email_to_validate) < 4 && strlen($p_email_to_validate) > 0 )
            $this->validation_errors['email_error'] = 'Your email of length ' . (strlen($p_email_to_validate)) . ' is less than 4, please increase the length';

        elseif(strlen($p_email_to_validate) > 64)
            $this->validation_errors['email_error'] = 'Your email of length ' . (strlen($p_email_to_validate)) . ' is greater than 32, please decrease the length';

        elseif(!filter_var($p_email_to_validate, FILTER_VALIDATE_EMAIL))
            $this->validation_errors['email_error'] = 'Invalid email';

        //elseif($this->sql_wrapper->email_exists($p_email_to_validate) == true)
            //$this->validation_errors['email_error'] = 'Email already taken';

        else
            $this->validation_errors['email_error'] = ' '; //if no validation was violated, produce no error messages
    }

    public function validate_username($p_username_to_validate)
    {
        if ($p_username_to_validate == " ")
            $this->validation_errors['username_error'] = 'A username is required';

        elseif(strlen($p_username_to_validate) < 2)
            $this->validation_errors['username_error'] = 'Your username of length ' . (strlen($p_username_to_validate)) . ' is less than 2, please increase the length';

        elseif(strlen($p_username_to_validate) > 32)
            $this->validation_errors['username_error'] = 'Your username of length ' . (strlen($p_username_to_validate)) . ' is greater than 32, please decrease the length';

        else
            $this->validation_errors['username_error'] = ' ';
    }

    public function validate_password($p_password_to_validate)
    {
        if ($p_password_to_validate == " ")
            $this->validation_errors['password_error'] = 'A password is required';

        elseif(strlen($p_password_to_validate) < 8)
            $this->validation_errors['password_error'] = 'Your password of length ' . (strlen($p_password_to_validate)) . ' is less than 8, please increase the length';

        elseif(strlen($p_password_to_validate) > 64)
            $this->validation_errors['password_error'] = 'Your password of length ' . (strlen($p_password_to_validate)) . ' is greater than 64, please decrease the length';

        elseif(!preg_match('/[A-Z]/', $p_password_to_validate))
            $this->validation_errors['password_error'] = 'Your password must have at least one capital letter';

        elseif(!preg_match('/[a-z]/', $p_password_to_validate))
            $this->validation_errors['password_error'] = 'Your password must have at least one lowercase letter';

        elseif(!preg_match('/[0-9]/', $p_password_to_validate))
            $this->validation_errors['password_error'] = 'Your password must have at least one number';

        elseif(preg_match('/\s/', $p_password_to_validate))
            $this->validation_errors['password_error'] = 'Your password must not contain spaces';

        else
            $this->validation_errors['password_error'] = ' ';
    }

    public function validate_password_confirm($p_password_confirm_to_validate)
    {
        if ($p_password_confirm_to_validate == " ")
            $this->validation_errors['password_confirm_error'] = 'A password conformation is required';

        elseif(strlen($p_password_confirm_to_validate) < 8)
            $this->validation_errors['password_confirm_error'] = 'Your password conformation of length ' . (strlen($p_password_confirm_to_validate)) . ' is less than 8, please increase the length';

        elseif(strlen($p_password_confirm_to_validate) > 64)
            $this->validation_errors['password_confirm_error'] = 'Your password conformation of length ' . (strlen($p_password_confirm_to_validate)) . ' is greater than 64, please decrease the length';

        elseif(!preg_match('/[A-Z]/', $p_password_confirm_to_validate))
            $this->validation_errors['password_error'] = 'Your password conformation must have at least one capital letter';

        elseif(!preg_match('/[a-z]/', $p_password_confirm_to_validate))
            $this->validation_errors['password_error'] = 'Your password must have at least one lowercase letter';

        elseif(!preg_match('/[0-9]/', $p_password_confirm_to_validate))
            $this->validation_errors['password_error'] = 'Your password conformation must have at least one number';

        elseif(preg_match('/\s/', $p_password_confirm_to_validate))
            $this->validation_errors['password_error'] = 'Your password conformation must not contain spaces';

        else
            $this->validation_errors['password_confirm_error'] = ' ';
    }

    public function check_passwords_match($p_password, $p_password_conformation)
    {
        if ($p_password == $p_password_conformation)
            return true;

        else
        {
            $this->validation_errors['password_confirm_error'] = 'Passwords do not match!';
            return false;
        }
    }

    public function check_email_exists($p_email_to_check)
    {
        //$this->sql_wrapper->set_db_handle($this->db_handle); //pass the models database handle object to the sql wrapper class
        //$this->sql_wrapper->set_sql_queries($this->sql_queries);

        $result = $this->sql_wrapper->email_exists($p_email_to_check);

        if($result == true)
        {
            $this->validation_errors['email_taken_error'] = 'Email already taken';
            return true;
        }

        else
        {
            $this->validation_errors['email_taken_error'] = ' ';
            return false;
        }
    }

    /*public function display_email_exists_message()
    {
        $details_taken = array('email_taken_message' => ' ', 'username_taken_message' => ' ');
        $details_taken['email_taken_message'] = 'Email already taken';

        $_SESSION['validation_errors'] =  $details_taken;
    }*/

    public function get_validate_messages($index_string)
    {
        return $this->validation_errors[$index_string];
    }

    public function display_validate_messages()
    {
        $validation_messages = array //put all of the messages into an associative array
        (
            'email_message' => $this->get_validate_messages('email_error'), //give each message an index
            'username_message' => $this->get_validate_messages('username_error'),
            'password_message' => $this->get_validate_messages('password_error'),
            'password_confirm_message' => $this->get_validate_messages('password_confirm_error'),
            'email_taken_message' => $this->get_validate_messages('email_taken_error')
        );

        $_SESSION['validation_errors'] = $validation_messages; //pass the array with it's messages into a session ready to be used on the twig template
    }

    /*public function get_email_taken_messages($index_string)
    {
        return $this->details_exist[$index_string];
    }

    public function display_email_check_messages()
    {
        $email_check_messages = array //put all of the messages into an associative array
        (
            'email_check_message' => $this->get_email_taken_messages('email_exists_error'), //give each message an index

        );

        $_SESSION['validation_errors'] = $email_check_messages; //pass the array with it's messages into a session ready to be used on the twig template
    }*/
}