<?php

namespace controllers; 
use system\Controller;

class Auth extends Controller{

    public function index(){
        $this->view->render("login", false);
    }

    public function login(){
        return $this->index();
    }

    public function register(){
        $this->view->render("registration");
    }
}