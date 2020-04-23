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

    public function getTask() {
        $sql = "SELECT * FROM tasks WHERE complete = 0 ORDER BY DATE DESC";
        $query = $this->connection->query($sql);
        return $query;
    }

    public function getCompleteTask(){
        $sql = "SELECT * FROM tasks WHERE complete = 1 ORDER BY DATE DESC";
        $query1 = $this->connection->query($sql);
        return $query1;
    }

}