<?php
require_once 'BaseController.php';

require_once __DIR__ . DIRECTORY_SEPARATOR .'../validation/TaskValidation.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .'../models/TaskModel.php';

class TaskController extends BaseController
{


    public function index(){
        $this->view('task_home');
//        $this->view('dashboard');
    }

    public function storeTask(){
        if ((new TaskValidation())->validation()){
            $redirect=url('task','index');
            return header('Location:'.$redirect);
        }

        if ((new TaskModel())->storeProcess()){
            $_SESSION['success'] = 'Task Inserted Successfully!!';
            $redirect=url('task','index');
            return header('Location:'.$redirect);
        }
        $_SESSION['error']='Something went wrong';
        $redirect=url('task','index');
        return header('Location:'.$redirect);

    }

}