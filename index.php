<?php


	spl_autoload_register(function($class_name){
		include str_replace("\\", DIRECTORY_SEPARATOR, $class_name) .".php";
	});

	
	$components = explode("/", substr($_SERVER['REQUEST_URI'], 1));
	
	new \system\Routes($components);