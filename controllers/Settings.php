<?php 

namespace controllers;

class Settings{
	public function __construct(){

    }
	
	public function index(){
		//Do something
		echo "Settings index.";
	}

	public function general($p1=false, $p2=false){
		echo "general settings page".$p1.$p2;
		//Do something
	}
	
}