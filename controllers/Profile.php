<?php

namespace controllers;
use system\Controller;
use models\User;

class Profile extends Controller{
    public $user;
    public function __construct(){
        
        if(!isset($_SESSION["id"])){
            header("Location: /");
        }
        parent:: __construct();
        $this->user = new User;
    }
    
    public function index(){
        $this->userInfo($_SESSION["id"]);
        $this->view->user = $this->user;
        $this->view->render("profile");
    }
    
    public function profile(){
        return $this->index();
    }

    public function uploadAvatar(){
    
    }

    public function friends(){
        $this->userInfo($_SESSION["id"]);
        $this->user->getFriends($_SESSION["id"]);
        $this->view->user = $this->user;
        $this->view->render("friends");
    }

    public function user($id){
        $this->userInfo($id);
        $this->view->user = $this->user;
        $this->view->render("profile");
    }

    public function userInfo($id){
        return $this->user->getUserInfo($id);
    }
}