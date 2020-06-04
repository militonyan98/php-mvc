<?php


	spl_autoload_register(function($class_name){
		include str_replace("\\", DIRECTORY_SEPARATOR,  $class_name) .".php";
	});

	
	$url = parse_url($_SERVER['REQUEST_URI']);
	$components = explode("/", $url["path"]);
	
	new \system\Routes($components);