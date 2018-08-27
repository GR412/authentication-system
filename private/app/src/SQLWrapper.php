<?php

class SQLWrapper
{
    private $c_obj_db_handle;
    private $c_obj_sql_queries;
    private $c_obj_stmt;
    private $c_arr_errors;

    public function __construct()
    {
        $this->c_obj_db_handle = null;
        $this->c_obj_sql_queries = null;
        $this->c_obj_stmt = null;
        $this->c_arr_errors = [];
    }

    public function __destruct() {}

    public function set_db_handle($p_obj_db_handle)
    {
        $this->c_obj_db_handle = $p_obj_db_handle;
    }

    public function set_sql_queries($p_obj_sql_queries)
    {
        $this->c_obj_sql_queries = $p_obj_sql_queries;
    }

    public function store_details($p_username, $p_email, $p_password)
    {
       // if ($this->user_username_exists($p_username) === true)
            //$this->set_session_var($p_username, $p_password);

       // else
            $this->create_user_account($p_username, $p_email, $p_password);

        return($this->c_arr_errors);
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

    public function create_user_account($p_username, $p_email, $p_password)
    {


        $f_sql_query = $this->c_obj_sql_queries->create_user();

        $f_arr_sql_parameters = [
            ':username' => $p_username,
            ':email' => $p_email,
            ':password' => $p_password
        ];

        $this->query_sql($f_sql_query, $f_arr_sql_parameters);
    }

    /*private function set_session_var($p_username, $p_email, $p_password)
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
        $this->c_arr_errors['db_error'] = false;
        $query_string = $p_sql_query;
        $arr_sql_parameters = $p_arr_sql_parameters;

        try
        {
            $f_temp_array = array();

            $this->c_obj_stmt = $this->c_obj_db_handle->prepare($query_string);

            if (sizeof($arr_sql_parameters) > 0)
            {
                foreach ($arr_sql_parameters as $f_param_key => $f_param_value)
                {
                    $f_temp_array[$f_param_key] = $f_param_value;
                    $this->c_obj_stmt->bindParam($f_param_key, $f_temp_array[$f_param_key], PDO::PARAM_STR);
                }
            }

            $f_execute_query = $this->c_obj_stmt->execute();
            $this->c_arr_errors['execute-OK'] = $f_execute_query;
        }

        catch(PDOException $exception_object)
        {
            $m_error_message  = 'PDO Exception caught. ';
            $m_error_message .= 'Error with the database access.' . "\n";
            $m_error_message .= 'SQL query: ' . $p_sql_query . "\n";
            $m_error_message .= 'Error: ' . var_dump($this->c_obj_stmt->errorInfo(), true) . "\n";
            // NB would usually output to file for sysadmin attention
            $this->c_arr_errors['db_error'] = true;
            $this->c_arr_errors['sql_error'] = $m_error_message;
        }
        return $this->c_arr_errors['db_error'];
    }

    public function row_count()
    {
        $f_num_rows = $this->c_obj_stmt->rowCount();
        return $f_num_rows;
    }

    /*public function safe_fetch_row()
    {
        $m_record_set = $this->c_obj_stmt->fetch(PDO::FETCH_NUM);
        return $m_record_set;
    }

    public function safe_fetch_array()
    {
        $m_arr_row = $this->c_obj_stmt->fetch(PDO::FETCH_ASSOC);
        $this->c_obj_stmt->closeCursor();
        return $m_arr_row;
    }

    public function last_inserted_ID()
    {
        $m_sql_query = 'SELECT LAST_INSERT_ID()';

        $this->safe_query($m_sql_query);
        $m_arr_last_inserted_id = $this->safe_fetch_array();
        $m_last_inserted_id = $m_arr_last_inserted_id['LAST_INSERT_ID()'];
        return $m_last_inserted_id;
    }*/

    public function generate_user_id()
    {

    }
}