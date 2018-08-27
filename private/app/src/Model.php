<?php

class Model
{
    private $email, $username, $password, $sql_wrapper, $sql_queries, $db_handle;

    public function __construct()
    {
        $this->email = null;
        $this->username = null;
        $this->password = null;
        $this->sql_wrapper = null;
        $this->sql_queries = null;
        $this->db_handle = null;
    }

    public function __destruct() {}

    public function set_user_values($p_username, $p_email, $p_password)
    {
        $this->email = $p_email;
        $this->username = $p_username;
        $this->password = $p_password;
    }

    public function set_sql_wrapper ($p_sql_wrapper)
    {
        $this->sql_wrapper = $p_sql_wrapper;
    }

    public function set_sql_queries ($p_sql_queries)
    {
        $this->sql_queries = $p_sql_queries;
    }

    public function set_db_handle ($p_db_handle)
    {
        $this->db_handle = $p_db_handle;
    }

    public function store_user_details ()
    {
        $m_store_result = false;

        $this->sql_wrapper->set_db_handle($this->db_handle);
        $this->sql_wrapper->set_sql_queries($this->sql_queries);

        $m_store_result = $this->sql_wrapper->store_details($this->username, $this->email, $this->password);
        //$m_store_result = $this->sql_wrapper->store_details('user_password', $this->password);

        return $m_store_result;
    }
}