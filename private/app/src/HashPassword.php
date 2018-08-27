<?php

class HashPassword
{
    public function hash_password($p_password_to_hash)
    {
        $hashed_password = '';

        if(!empty($p_password_to_hash))
        {
            //$arr_options = array('cost' => BCRYPT_COST);
            $hashed_password = password_hash($p_password_to_hash, PASSWORD_BCRYPT);
        }

        return $hashed_password;
    }

    public function authenticate_user($p_user_password, $p_stored_hash)
    {
        $user_authenticated = false;

        if(!empty($p_user_password) && !empty($p_stored_hash))
        {
            if (password_verify($p_user_password, $p_stored_hash) == true)
                $user_authenticated = true;
        }

        return $user_authenticated;
    }
}