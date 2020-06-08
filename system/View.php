<?php
namespace system;

class View {
	public function render($view_file, $include_layout=false){
		
		if(!file_exists("views/".$view_file.".php")){
            echo "File $view_file not found.";
        }else{
            if($include_layout==true){
                include "views/header.php";
                include "views/layout.php";
                include "views/footer.php";
            }
            else{
                include "views/layout.php";
            }
        }
		
    }

}