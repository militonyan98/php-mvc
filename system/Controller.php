<?php
namespace system;
use system\View;
use helpers\FlashHelper;

class Controller {
	
	protected $view;

	function __construct(){
		$this->view = new View;
    }
}