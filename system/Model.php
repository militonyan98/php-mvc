<?php

namespace system;
use system\Database;

class Model {
    public $user_database;
    public function __construct(){
        $this->user_database = new Database("localhost", "root", "", "users");
    }
}