<?php
namespace system;
use controllers\Auth;
class View {
	public function render($view_file, $include_layout=true){
		
		if(!file_exists("views/".$view_file.".php")){
            echo "File $view_file not found.";
        }else{
            if($include_layout){
                include "views/layout.php";
            }
            else{
                include "views/".$view_file.".php";
            }
        }
		
    }

}