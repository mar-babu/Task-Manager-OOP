<?php


class Bootstrap
{
    public $controller;
    public $method;
    public function __construct()
    {
        $url = $_GET;
//        print_r($url);
        $controller=$_GET['controller'] ?? '';
        $method=$_GET['method'] ?? '';
        $controller=str_replace('-','',ucfirst($controller).'Controller');
//                print_r($controller);

        try{
            if (file_exists('app/application/controllers/'.$controller.'.php')){
                require_once 'app/application/controllers/'.$controller.'.php';
                $this->controller=new $controller;

                if (!method_exists($this->controller,$method)){
                    throw new Exception("{$method}was not found");
                }
                $this->method=$method;
                call_user_func([$this->controller,$this->method],[]);

            }else{
//                throw new Exception("{$controller}was not found");
            }


        }catch (Exception $exception){
            echo $exception->getMessage();
        }


    }

}