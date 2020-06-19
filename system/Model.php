<?php

namespace system;
use system\Database;

class Model {
    public $db;
    public function __construct(){
        $this->db = new Database();
    }
}