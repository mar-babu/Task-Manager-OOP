<?php


class TaskValidation
{
    protected $request;
    public function __construct()
    {
        $this->request=$_POST;
    }

    public function validation(){
        $task = $this->request['task'];
        $date = $this->request['date'];
        if ($task && $date ==null){
            $_SESSION['error']='Task or Date Is Required!!';
            return true;
        }
//        elseif($date==null){
//            $_SESSION['error']='Date Is Required!!';
//            return true;
//        }
        return false;
    }

}