<?php

class Validate_Sanitize

{
    public function __construct(){}

    public function __destruct(){}

    public function sanitize_string($p_string_to_sanitize)
    {
        $f_sanitized_string = false;

        if (!empty($p_string_to_sanitize))
            $f_sanitized_string = filter_var($p_string_to_sanitize, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        return $f_sanitized_string;
    }

    public function validate_email($p_email_to_validate)
    {
        $f_validated_email = $this->sanitize_string($p_email_to_validate);

        if(strlen($f_validated_email) < 4)
            $f_validated_email = 'Your email of length ' . (strlen($f_validated_email)) . 'is less than 4, please increase the length';

        elseif(strlen($f_validated_email) > 64)
            $f_validated_email = 'Your email of length ' . (strlen($f_validated_email)) . 'is greater than 64, please decrease the length';

        return $f_validated_email;
    }

    public function validate_username($p_username_to_validate)
    {
        $f_validated_username = $this->sanitize_string($p_username_to_validate);

        if(strlen($f_validated_username) < 4)
            $f_validated_username = 'Your username of length ' . (strlen($f_validated_username)) . 'is less than 4, please increase the length';

        elseif(strlen($f_validated_username) > 20)
            $f_validated_username = 'Your username of length ' . (strlen($f_validated_username)) . 'is greater than 20, please decrease the length';

        return $f_validated_username;
    }

    public function validate_password($p_password_to_validate)
    {
        $f_validated_password = $this->sanitize_string($p_password_to_validate);

        if(strlen($f_validated_password) < 8)
            $f_validated_password = 'Your password of length ' . (strlen($f_validated_password)) . 'is less than 8, please increase the length';

        elseif(strlen($f_validated_password) > 32)
            $f_validated_password = 'Your password of length ' . (strlen($f_validated_password)) . 'is greater than 32, please decrease the length';

        elseif(!preg_match('/^[A-Z]{1}$/', $f_validated_password))
            $f_validated_password = 'Your password must have at least one capital letter';

        elseif(!preg_match('/^[0-9]{1}$/', $f_validated_password) === true)
                $f_validated_password = 'Your password must have at least one number';

        return $f_validated_password;
    }
}