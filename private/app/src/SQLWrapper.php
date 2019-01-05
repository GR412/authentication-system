<?php

namespace App\src;

use PDO;

//please note that $_p represents an incoming parameter

class SQLWrapper
{
    private $obj_db_handle, $obj_sql_queries, $obj_stmt, $arr_errors;

    public function __construct() //initialise each model field variable to a default value of null
    {
        $this->obj_db_handle = null;
        $this->obj_sql_queries = null;
        $this->obj_stmt = null;
        $this->arr_errors = [];
    }

    public function __destruct() {}

    public function set_db_handle($p_obj_db_handle) //assigns the incoming database handle object to the models database handle field variable
    {
        $this->obj_db_handle = $p_obj_db_handle;
    }

    public function set_sql_queries($p_obj_sql_queries) //assigns the incoming sql queries object to the models sql queries field variable
    {
        $this->obj_sql_queries = $p_obj_sql_queries;
    }

    /*public function email_exists($p_email)
    {
        $email_exists = false;

        $f_sql_query = $this->obj_sql_queries->check_details();

        $f_arr_sql_parameters = [
            ':email' => $p_email,
            //':password' => $p_password,
        ];

        $this->query_sql($f_sql_query, $f_arr_sql_parameters);

        //$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        //$this->c_obj_stmt = $this->c_obj_db_handle->prepare($f_sql_query);
        //$this->c_obj_stmt->bindParam(':name', $p_username);
        //$this->c_obj_stmt->execute();

        if ($this->row_count() > 0)
            $email_exists = false;

        else
            $email_exists = true;

        return $email_exists;
    }*/

    public function store_details($p_email, $p_username, $p_password) //
    {
        $f_sql_query = $this->obj_sql_queries->create_user();

        $f_arr_sql_parameters = [
            ':email' => $p_email,
            ':username' => $p_username,
            ':password' => $p_password
        ];

        $this->query_sql($f_sql_query, $f_arr_sql_parameters);
    }

    public function attempt_authentication($p_username, $p_password)
    {
         echo 'user inputted password is: ' . $p_password . ' ||';

        if($this->username_exists($p_username) === true)
        {
            $row = $this->obj_stmt->fetch(PDO::FETCH_ASSOC);

            $hashed_password = $row["password"];

            echo 'hashed password stored in database is: ' . $hashed_password . ' || ';

            if(password_verify($p_password, $hashed_password) === true)
            {
                echo 'passwords match! You have been logged in!';
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $p_username;
            }

            else
                echo 'passwords do NOT match! || ';
        }

    }

    /*public function user_username_exists($p_session_key)
    {
        $user_email_exists = false;

        $f_sql_query = $this->c_obj_sql_queries->check_user_username();

        $f_arr_sql_parameters = [
            ':username' => $p_session_key,
            ':email' => $p_session_key
        ];

        $this->query_sql($f_sql_query, $f_arr_sql_parameters);

        if ($this->row_count() > 0)
            $user_email_exists = true;

        return $user_email_exists;
    }*/

    public function email_exists($p_email)
    {
        $email_exists = false;

        $f_sql_query = $this->obj_sql_queries->check_email();

        $f_arr_sql_parameters = [
            ':email' => $p_email,
            //':password' => $p_password,
        ];

        $this->query_sql($f_sql_query, $f_arr_sql_parameters);

        if ($this->row_count() == 1)
            $email_exists = true;

        return $email_exists;
    }

    public function username_exists($p_username)
    {
        $username_exists = false;

        $f_sql_query = $this->obj_sql_queries->check_username();

        $f_arr_sql_parameters = [
            ':username' => $p_username,
            //':password' => $p_password,
        ];

        $this->query_sql($f_sql_query, $f_arr_sql_parameters);

        if ($this->row_count() == 1)
        {
            $username_exists = true;
            //echo 'username + password exist || ';
        }

       // else
            //echo 'username + password are non existent || ';

        //echo $this->row_count() . ' rows containing the username + password || ';

        return $username_exists;
    }

    /*public function get_details($p_password)
    {
        $m_query_string = $this->obj_sql_queries->get_details();

        $m_arr_query_parameters = [
            //':username' => $p_username,
            ':password' => $p_password,
        ];

        $this->query_sql($m_query_string, $m_arr_query_parameters);
        //return $this->safe_fetch_array();
    }


    public function set_session_var($p_username, $p_email, $p_password)
    {
        $m_query_string = $this->c_obj_sql_queries->update_user();

        $m_arr_query_parameters = [
            ':username' => $p_username,
            ':email' => $p_email,
            ':password' => $p_password
        ];

        $this->query_sql($m_query_string, $m_arr_query_parameters);
    }*/

    public function query_sql($p_sql_query, $p_arr_sql_parameters = null)
    {
        $this->arr_errors['db_error'] = false;
        $query_string = $p_sql_query;
        $arr_sql_parameters = $p_arr_sql_parameters;

        try
        {
            $f_temp_array = array();

            $this->obj_stmt = $this->obj_db_handle->prepare($query_string);

            if (sizeof($arr_sql_parameters) > 0)
            {
                foreach ($arr_sql_parameters as $f_param_key => $f_param_value)
                {
                    $f_temp_array[$f_param_key] = $f_param_value;
                    $this->obj_stmt->bindParam($f_param_key, $f_temp_array[$f_param_key], PDO::PARAM_STR);
                }
            }

            $f_execute_query = $this->obj_stmt->execute();
            $this->arr_errors['execute-OK'] = $f_execute_query;
        }

        catch(PDOException $exception_object)
        {
            $m_error_message  = 'PDO Exception caught. ';
            $m_error_message .= 'Error with the database access.' . "\n";
            $m_error_message .= 'SQL query: ' . $p_sql_query . "\n";
            $m_error_message .= 'Error: ' . var_dump($this->obj_stmt->errorInfo(), true) . "\n";
            // NB would usually output to file for sysadmin attention
            $this->arr_errors['db_error'] = true;
            $this->arr_errors['sql_error'] = $m_error_message;
        }
        return $this->arr_errors['db_error'];
    }

    public function row_count()
    {
        $f_num_rows = $this->obj_stmt->rowCount();
        return $f_num_rows;
    }

    public function safe_fetch_row()
    {
        //$m_record_set = $this->c_obj_stmt->fetch();
        //return $m_record_set;
    }

    public function safe_fetch_array()
    {
        //$m_arr_row = $this->c_obj_stmt->fetch(PDO::FETCH_ASSOC);
        //$this->obj_stmt->closeCursor();
        //return $m_arr_row;
    }

    public function last_inserted_ID()
    {
        $m_sql_query = 'SELECT LAST_INSERT_ID()';

        $this->safe_query($m_sql_query);
        $m_arr_last_inserted_id = $this->safe_fetch_array();
        $m_last_inserted_id = $m_arr_last_inserted_id['LAST_INSERT_ID()'];
        return $m_last_inserted_id;
    }

    public function generate_user_id()
    {

    }
}