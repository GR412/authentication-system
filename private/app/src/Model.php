<?php

namespace App\src;

//please note that $_p represents an incoming parameter

class Model
{
    private $email, $username, $password, $sql_wrapper, $sql_queries, $db_handle;

    public function __construct() //initialise each model field variable to a default value of null
    {
        $this->email = null;
        $this->username = null;
        $this->password = null;
        $this->sql_wrapper = null;
        $this->sql_queries = null;
        $this->db_handle = null;
    }

    public function __destruct() {}

    public function set_user_values($p_email, $p_username, $p_password) //assigns the incoming user values to the models field variable
    {
        $this->email = $p_email;
        $this->username = $p_username;
        $this->password = $p_password;
    }

    /*public function set_user_email($p_email)
    {
        $this->email = $p_email;
    }

    public function perform_detail_retrieval($p_detail){
        if($p_detail == 'username'){
            return $this->username;
        }
        else if($p_detail == 'password'){
            return $this->password;
        }
    }*/

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

    public function register_user() //stores the newly created user values into the database to complete the registration process
    {
        $m_store_result = false;

        $this->sql_wrapper->set_db_handle($this->db_handle); //pass the models database handle object to the sql wrapper class
        $this->sql_wrapper->set_sql_queries($this->sql_queries); //pass the models sql queries object to the sql wrapper class
        $this->sql_wrapper->email_exists($this->email);


        $this->sql_wrapper->store_details($this->email, $this->username, $this->password); //pass the models email, username and password field variables to the sql wrapper ready for database insertion
    }

    public function authenticate_user()
    {
        $this->sql_wrapper->set_db_handle($this->db_handle);
        $this->sql_wrapper->set_sql_queries($this->sql_queries);

        $this->sql_wrapper->attempt_authentication($this->username, $this->password);
    }

  /*public function check_email ()
    {
        $this->sql_wrapper->set_db_handle($this->db_handle);
        $this->sql_wrapper->set_sql_queries($this->sql_queries);

        return $this->sql_wrapper->email_exsists($this->email);
    }*/
}