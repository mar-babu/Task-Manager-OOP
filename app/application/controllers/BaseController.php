<?php

class BaseController
{
    protected function view($view,$data=[]){

        if (!file_exists(__DIR__.DIRECTORY_SEPARATOR.'../views/'.$view.'.php')){
            throw new Exception("{$view} was not found");
        }
        extract($data);
        include __DIR__.DIRECTORY_SEPARATOR.'../views/'.$view.'.php';
    }

    public function model($model){

        if (!file_exists(__DIR__.DIRECTORY_SEPARATOR.'../models/'.$model.'.php')){
            throw new Exception("{$model} was not found");
        }
        include __DIR__.DIRECTORY_SEPARATOR.'../models/'.$model. '.php';
    }
}