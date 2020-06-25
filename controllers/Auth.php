<?php

namespace controllers; 
use system\Controller;
use models\User;
use helpers\FlashHelper;

class Auth extends Controller{

    public function index(){
        $valid=true;

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            session_unset();
            if(empty($_POST["email"])){
                $valid=false;
                FlashHelper::setFlash("emailError", "Email is required");
            }
            else{
                $email = $_POST["email"];
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $valid = false;
                    FlashHelper::setFlash("emailError", "Invalid email format");
                }
            }

            if(empty($_POST["password"])){
                $valid = false;
                FlashHelper::setFlash("passwordError", "Password is required");
            }
            else{
                $password = $_POST["password"];
            }

            if($valid){
                $user = new User;
                $login = $user->login($email, $password);
               
                if(!$login["error"]){
                    $getUser = $login["data"];
                    if(empty($_SESSION['id'])){
                        echo("session id is empty");
                        $_SESSION['id']=$getUser['user_id'];
                        header('Location: /profile');
                        
                    }
                    else{
                        header('Location: /profile');
                    }
                }
                else{
                  header('Location: /error');
                }
            }
        
        }
        $this->view->render("login");

    }


    public function registration(){
        $errorMsg = "";
        $valid = true;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!isset($_POST["fname"])){
                $valid = false;
                FlashHelper::setFlash("fnameErr", "First name is required");
            }
            else{
                $fname = $_POST["fname"];
                if(!preg_match("/^[A-Za-z][A-Za-z\'\-]+([\ A-Za-z][A-Za-z\'\-]+)*/",$fname)){
                    FlashHelper::setFlash("fnameErr", "Only letters and white space allowed");
                }
            }

            if(!isset($_POST["lname"])){
                $valid = false;
                FlashHelper::setFlash("lnameErr", "Last name is required");
            }
            else{
                $lname = $_POST["lname"];
                if(!preg_match("/^[A-Za-z][A-Za-z\'\-]+([\ A-Za-z][A-Za-z\'\-]+)*/",$lname)){
                    FlashHelper::setFlash("lnameErr", "Only letters and white space allowed");
                }
            }

            if(!isset($_POST["gender"]) && $_POST["gender"]!="") {
                $valid = false;
                FlashHelper::setFlash("genderErr", "Gender is required");
            }
            else {
                $gender = $_POST["gender"];
            }

            if(!isset($_POST["email"])) {
                $valid = false;
                FlashHelper::setFlash("emailErr", "Email is required");
            }
            else{
                $user = new User;
                $email = $_POST["email"];
                $emailQuery = "SELECT email FROM user WHERE email='$email'";
                $getEmail = $user->db->select($emailQuery)["data"];
                if((!filter_var($email, FILTER_VALIDATE_EMAIL)) || !empty($getEmail['email'])) {
                    FlashHelper::setFlash("emailErr", "Invalid email format");
                    $valid = false;
                }
            }

            if(!isset($_POST["password"])){
                $valid = false;
                FlashHelper::setFlash("passwordErr", "Password is required");
            }
            else{
                $password = $_POST["password"];
            }

            if(!isset($_POST["passwordConfirm"])){
                $valid = false;
                FlashHelper::setFlash("passwordConfirmErr", "Password confirmation is required");
            } 
            else{
                $passwordConfirm = $_POST["passwordConfirm"];
            }
            if(strcmp($passwordConfirm, $password)!==0){
                $valid=false;
                FlashHelper::setFlash("passwordConfirmErr", "Passwords don't match");
            }


            if($valid){
                $user = new User;
                $reg = $user->registration($fname, $lname, $gender, $email, $password);

                if($reg){
                    header('Location: /auth/index');
                }
                else{
                    $errorMsg = $errorMsg."query error performed"."\r\n".$this->user->db->error();
                    FlashHelper::setFlash("errorMsg", $errorMsg);
                    header('Location: /error');
                };
            }
            // else{
            //     header('Location: /auth/registration');
            // }

            $_SESSION['error'] = $errorMsg;

        }

        $this->view->render("registration");
    }
}