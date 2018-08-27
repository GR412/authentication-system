<?php

class SQLQueries
{
    public function __construct() { }

    public function __destruct() { }

    public static function check_user_username()
    {
        $m_query_string  = "SELECT username ";
        $m_query_string .= "FROM user_details ";
        $m_query_string .= "WHERE username= :username ";
        $m_query_string .= "AND email = :email ";
        $m_query_string .= "LIMIT 1";
        return $m_query_string;
    }

    public static function create_user()
    {
        $m_query_string  = "INSERT INTO user_details ";
        $m_query_string .= "SET username = :username, ";
        $m_query_string .= "email = :email, ";
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

    /*public static function get_user_details()
    {
        $m_query_string  = "SELECT session_value ";
        $m_query_string .= "FROM session ";
        $m_query_string .= "WHERE session_id = :local_session_id ";
        $m_query_string .= "AND session_var_name = :session_var_name";
        return $m_query_string;
    }*/
}