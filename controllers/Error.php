<?php

namespace controllers;
use system\Controller;

class Error extends Controller{

    public function index(){
        $this->view->render("error");
    }
    
}