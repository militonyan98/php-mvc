<?php

namespace controllers;
use system\Controller;
use models\User;

class Profile extends Controller{

    public function __construct(){
     
        if(!isset($_SESSION["id"])){
            header("Location: /");
        }
        parent:: __construct();
    }
    
    public function index(){
        $this->user = new User();
        $this->user->getUserInfo($_SESSION["id"]);
        $this->view->user = $this->user;
        $this->view->render("profile");
    }
    
    public function profile(){
        return $this->index();
    }

    public function upload_avatar(){
    
    }
}