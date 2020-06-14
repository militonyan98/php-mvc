<?php 

namespace controllers;
use system\Controller;

class Settings extends Controller{
	
	public function index(){
		echo "Settings index.";
		$x = "test";
		$this->view->x=$x;
		$this->view->render("settings");
	}

	public function general($p1=false, $p2=false){
		echo "general settings page".$p1.$p2;
	}
	
}