<?php
namespace system;

class View {
	public function render($view_file){
		
		if(!file_exists("views/".$view_file.".php")){
            echo "File $view_file not found.";
        }else{
            include "views/".$view_file.".php";
        }
		
    }

}