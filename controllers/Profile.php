<?php

namespace controllers;
use system\Controller;

class Profile extends Controller{

    public function __construct(){
     
        if(!isset($_SESSION["id"])){
            header("Location: /");
        }
        parent:: __construct();
    }
    
    public function index(){
        $this->view->render("profile");
    }
    
    public function profile(){
        return $this->index();
    }
}