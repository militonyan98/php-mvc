<?php 

namespace controllers;
use system\Controller;

class Settings extends Controller{
	// public function __construct(){
	// 	parent:: __construct();
    // }
	
	public function index(){
		echo "Settings index.";
		$x = "test";
		$this->view->x=$x;
		$this->view->render("settings", true);
	}

	public function general($p1=false, $p2=false){
		echo "general settings page".$p1.$p2;
	}
	
}