<?php
namespace system;
use FFI\Exception;
class View {
	protected $data;
	public function render($view_file){
		
		//check if file exists
		
		include "views/".$view_file.".php";
    }
    
    // function assign($key, $val) {
    //     $this->data[$key] = $val;
    // }

    public function __get($varName){

        if (!array_key_exists($varName,$this->data)){
            throw new Exception('.....');
        }
        else return $this->data[$varName];
  
     }
  
     public function __set($varName,$value){
        $this->data[$varName] = $value;
     }
}