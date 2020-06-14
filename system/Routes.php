<?php

namespace system;

class Routes {
	
	function __construct($components){
		if(!empty($components[0])){
			$directory = "controllers".DIRECTORY_SEPARATOR.ucfirst($components[0].".php");
			$ctrl_name = $components[0];
			if(file_exists($directory)){
				$class_name = "controllers\\".ucfirst($ctrl_name);
				if(class_exists($class_name)){
					$ctrl_obj = new $class_name;
					if(!empty($components[1])){
						if(method_exists($ctrl_obj, $components[1])){
							$method = $components[1];
							$params = array_slice($components, 2);
							call_user_func_array([$ctrl_obj, $method], $params);
						}
						else{
							echo "Method ".$components[1]."() not found.";
						}
					}
					else{
						if(method_exists($ctrl_obj, "index")){
							$ctrl_obj->index();
						}
						else{
							echo "Method index() not found.";
						}
					}
				}
				else{
					echo "Class $class_name not found.";
				}
			}
			else{
				echo "File $directory not found.";
			}
		}
		else{
			$dir = "controllers".DIRECTORY_SEPARATOR."Auth.php";
			if(file_exists($dir)){
				$default_class = "controllers\\Auth";
				if(class_exists($default_class)){
					$default_obj = new $default_class;
					if(method_exists($default_obj, "index")){
						$default_obj->index();
					}
					else{
						echo "Method index() of class Auth not found.";
					}
				}
				else{
					echo "Class not found.";
				}
			}
			else{
				echo "File $dir not found.";
			}

		}
	}
	
}