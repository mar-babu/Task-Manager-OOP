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
        $action = $this->request['action'] ?? '';
        if ('add' == $action){
            $task = $this->request['task'];
            $date = $this->request['date'];
            $sql = "INSERT INTO tasks(task,date) VALUES ('$task','$date')";
            $query = $this->connection->query($sql);
            if (!$query) {
                return false;
            }  return true;
        } elseif ('complete' == $action){
            $taskid = $this->request['taskid'];
            if ($taskid) {
                $sql = "UPDATE tasks SET complete = 1 WHERE id={$taskid} LIMIT 1";
                $query = $this->connection->query($sql);
                if (!$query) {
                    return false;
                }         return true;

            }
        }elseif ('incomplete' == $action){
            $taskid = $this->request['taskid'];
            if ($taskid) {
                $sql = "UPDATE tasks SET complete = 0 WHERE id={$taskid} LIMIT 1";
                $query = $this->connection->query($sql);
                if (!$query) {
                    return false;
                }         return true;

            }
        }elseif ('delete' == $action){
            $taskid = $this->request['taskid'];
            if ($taskid) {
                $sql = "DELETE FROM tasks WHERE id={$taskid} LIMIT 1";
                $query = $this->connection->query($sql);
                if (!$query) {
                    return false;
                }         return true;

            }
        }elseif ('bulkcomplete' == $action){
            $taskids = $this->request['taskids'];
            $_taskids = join(",",$taskids);
            if ($taskids) {
                $sql = "UPDATE tasks SET complete = 1 WHERE id in ($_taskids)";
                $query = $this->connection->query($sql);
                if (!$query) {
                    return false;
                }         return true;

            }
        }elseif ('bulkdelete' == $action){
            $taskids = $this->request['taskids'];
            $_taskids = join(",",$taskids);
            if ($taskids) {
                $sql = "DELETE FROM tasks WHERE id in ($_taskids)";
                $query = $this->connection->query($sql);
                if (!$query) {
                    return false;
                }         return true;

            }
        }

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