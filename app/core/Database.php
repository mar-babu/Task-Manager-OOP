<?php

class Database
{
    private $host;
    private $username;
    private $password;
    private $database;


    public function dbConnect()
    {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = 'tasks';
        try {
            $con_obj = new mysqli($this->host, $this->username, $this->password, $this->database);
            return $con_obj;
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

}