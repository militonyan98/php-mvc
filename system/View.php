<?php
namespace system;
use helpers\FlashHelper;
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

    function renderStylesheet($link){
        echo "<link rel='stylesheet' href='$link'>";
    }

}