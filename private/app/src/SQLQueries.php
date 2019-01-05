<?php

namespace App\src;

class SQLQueries
{
    public function __construct() { }

    public function __destruct() { }

    public static function check_details()
    {
        $m_query_string  = "SELECT username, password ";
        $m_query_string .= "FROM user_details ";
        $m_query_string .= "WHERE username = :username ";
        //$m_query_string .= "LIMIT 1";
        return $m_query_string;
    }

    public static function check_email()
    {
        $m_query_string  = "SELECT email ";
        $m_query_string .= "FROM user_details ";
        $m_query_string .= "WHERE email = :email ";
        //$m_query_string .= "LIMIT 1";
        return $m_query_string;
    }

    public static function check_username()
    {
        $m_query_string  = "SELECT username ";
        $m_query_string .= "FROM user_details ";
        $m_query_string .= "WHERE username = :username ";
        //$m_query_string .= "LIMIT 1";
        return $m_query_string;
    }

    public static function create_user()
    {
        $m_query_string  = "INSERT INTO user_details ";
        $m_query_string .= "SET email = :email, ";
        $m_query_string .= "username = :username, ";
        $m_query_string .= "password = :password ";
        return $m_query_string;
    }

    public static function update_user()
    {
        $m_query_string  = "UPDATE user_details ";
        $m_query_string .= "SET password = :password ";
        $m_query_string .= "WHERE username = :username ";
        $m_query_string .= "AND email = :email";
        return $m_query_string;
    }

    public static function get_details()
    {
        $m_query_string  = "SELECT password ";
        $m_query_string .= "FROM user_details ";
        $m_query_string .= "WHERE password = :password ";
        return $m_query_string;
    }
}