<?php

namespace controllers; 
use system\View;

class Auth {
    protected $view;
    public function __construct(){
        $this->view = new View;
    }

    public function index(){
        $this->view->render("login", true);
    }

    public function login(){
        return $this->index();
    }

    public function register(){
        $this->view->render("registration", true);
    }
}