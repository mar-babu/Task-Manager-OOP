<?php
require_once 'BaseController.php';
require_once 'app/application/models/UserModel.php';
class LoginController extends BaseController {

    public function loginAction(){

        if (isset($_POST['submit'])){
            $email=$_POST['email'];
            $password=$_POST['password'];
            if ((new UserModel())->validate($email, $password)) {
                $_SESSION['logged_in'] = true;
                $redirect = url('task','index',[]);
                header('Location: ' . $redirect);
            }

        }
    }


    public function logout(){
        session_destroy();
        header('Location:index.php');
    }





}
