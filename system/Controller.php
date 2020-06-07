<?php
namespace system;
use system\View;

class Controller {
	
	protected $view;
	
	function __construct(){
		$this->view = new View;
    }
}