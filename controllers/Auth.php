<?php

namespace controllers; 
use system\Controller;
use models\User;

class Auth extends Controller{
       

    public function index(){
        $user = new User;
        $email = $emailError = $password = $passwordError = $errorMsg = "";
        $valid=true;

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            session_unset();
            if(empty($_POST["email"])){
                $valid=false;
                $emailError = "Email is required";
            }
            else{
                $email = $_POST["email"];
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $valid = false;
                    $emailError = "Invalid email format";
                }
            }

            if(empty($_POST["password"])){
                $valid = false;
                $passwordError = "Password is required";
            }
            else{
                $password = $_POST["password"];
            }

            if($valid){
                $login = $user->login($email, $password);
               
                if(!$login["error"]){
                    $getUser = $login["data"][0];
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
            else{
                $this->view->errors=[];
                $this->view->errors["emailError"] = $emailError;
                $this->view->errors["passwordError"] = $passwordError;
                $this->view->render("login");
            }
        
        }
        else{
            $this->view->render("login");
        }

    }


    public function registration(){
        $user = new User;
        $fname = $lname = $gender = $email = $emailErr = $password = $passwordConfirm = "";
        $fnameErr = $lnameErr = $genderErr = $passwordErr = $passwordConfirmErr = "";
        $errorMsg = "";
        $valid = true;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!isset($_POST["fname"])){
                $valid = false;
                $fnameErr = "First name is required";
            }
            else{
                $fname = $_POST["fname"];
                if(!preg_match("/^[A-Za-z][A-Za-z\'\-]+([\ A-Za-z][A-Za-z\'\-]+)*/",$fname)){
                    $fnameErr = "Only letters and white space allowed";
                }
            }

            if(!isset($_POST["lname"])){
                $valid = false;
                $lnameErr = "Last name is required";
            }
            else{
                $lname = $_POST["lname"];
                if(!preg_match("/^[A-Za-z][A-Za-z\'\-]+([\ A-Za-z][A-Za-z\'\-]+)*/",$lname)){
                    $lnameErr = "Only letters and white space allowed";
                }
            }

            if(!isset($_POST["gender"]) && $_POST["gender"]!="") {
                $valid = false;
                $genderErr = "Gender is required";
            }
            else {
                $gender = $_POST["gender"];
            }

            if(!isset($_POST["email"])) {
                $valid = false;
                $emailErr = "Email is required";
            }
            else{
                $email = $_POST["email"];
                $emailQuery = "SELECT email FROM user WHERE email='$email'";
                $getEmail = $user->user_database->select($emailQuery)["data"][0];
                if((!filter_var($email, FILTER_VALIDATE_EMAIL)) || !empty($getEmail['email'])) {
                    $emailErr = "Invalid email format";
                    $valid = false;
                }
            }

            if(!isset($_POST["password"])){
                $valid = false;
                $passwordErr = "Password is required";
            }
            else{
                $password = $_POST["password"];
            }

            if(!isset($_POST["passwordConfirm"])){
                $valid = false;
                $passwordConfirmErr = "Password confirmation is required";
            } 
            else{
                $passwordConfirm = $_POST["passwordConfirm"];
            }
            if(strcmp($passwordConfirm, $password)!==0){
                $valid=false;
                    $passwordConfirmErr = "Passwords don't match";
            }


            if($valid){

                $reg = $user->registration($fname, $lname, $gender, $email, $password);

                if($reg){
                    header('Location: /auth/index');
                }
                else{
                    $errorMsg = $errorMsg."query error performed"."\r\n".$this->user->user_database->error();
                    header('Location: /error-page');
                };
            }
            else{
                header('Location: index');
            }

            $_SESSION['error'] = $errorMsg;

        }

        
        if(!$valid){
            
          $this->view->errors = [];
          $this->view->errors["fnameErr"] = $fnameErr;
          $this->view->errors["lnameErr"] = $lnameErr;
          $this->view->errors["genderErr"] = $genderErr;
          $this->view->errors["passwordErr"] = $passwordErr;
          $this->view->errors["passwordConfirmErr"] = $passwordConfirmErr;
          $this->view->errors["emailErr"] = $emailErr;
        
        }

        $this->view->render("registration");
    }
}