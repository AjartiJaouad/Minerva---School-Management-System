<?php
use App\Mosels\User;
class AuthController{
    public function login(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $email=$_POST['email'] ?? '';
            $password = $_POST['password'] ?? '' ;

            $userModel =new User();
            $user = userModel->findByEmail($email);
            if($user && password_verify($password ,$user['password'])){
                session_start();
                $_SESSION['user_id'] =$user['id'];
                $_SESSION['role'] =$user['role'];
                $_SESSION['name'] =$user['name'];

                if($user ['role']==='teacher'){
                    header('Location:/teacher/dashbard');
                }else{
                    header('Location:/student/dashbard');
                }
                exit;
            }else{
                echo "email ou mot de pas incocrrect";
            }

            }
        }
        public function logout(){
            session_start();
            session_destroy();
            header('Location: /login');
        }
    }
