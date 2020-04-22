<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../core/Database.php';

class TaskModel extends Database
{
    protected $request;
    protected $connection;

    public function __construct() {
        $this->request = $_POST;
        $this->connection = $this->dbConnect();
    }

    public function storeProcess() {
        $task = $this->request['task'];
        $date = $this->request['date'];
        $sql = "INSERT INTO tasks(task,date) VALUES ('$task','$date')";
        $query = $this->connection->query($sql);
        if (!$query) {
            return false;
        }
        return true;

    }

}