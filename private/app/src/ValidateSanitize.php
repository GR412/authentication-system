<?php

namespace App\src;

//please note that $_p represents an incoming parameter

class ValidateSanitize
{
    public $validation_errors = array('email_error' => ' ', 'username_error' => ' ', 'password_error' => ' ', 'password_confirm_error' => ' ');

    //protected $errors;

    public function __construct(){ }

    public function __destruct(){ }

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

        elseif(!preg_match('/[0-9]/', $p_password_confirm_to_validate))
            $this->validation_errors['password_error'] = 'Your password conformation must have at least one number';

        elseif(preg_match('/\s/', $p_password_confirm_to_validate))
            $this->validation_errors['password_error'] = 'Your password conformation must not contain spaces';

        else
            $this->validation_errors['password_confirm_error'] = ' ';
    }

    public function get_validate_messages($index_string)
    {
        return $this->validation_errors[$index_string];
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

    public function does_email_exist($p_result)
    {
        //if ($p_result === true)
           // $this->validation_errors['email_error'] = 'Email is already taken';

        //else
            //$this->validation_errors['email_error'] = ' ';
    }
}