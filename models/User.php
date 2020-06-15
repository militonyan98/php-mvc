<?php

namespace models;
use system\Model;

class User extends Model{
    public $userInfo;
	public function login($email, $password){
        $email = $this->user_database->escapeString($email);
        $passwordHash = md5($password);
        $query = "SELECT `user_id` FROM user WHERE `password` = '$passwordHash' AND email = '$email'";
        $getUser = $this->user_database->select($query);
        return $getUser;
    }


    public function registration($firstName, $lastName, $gender, $email, $password){
        $email = $this->user_database->escapeString($email);
        $passwordHash = md5($password);
        $data = [];
        $data["f_name"] = $firstName;
        $data["l_name"] = $lastName;
        $data["gender"] = $gender;
        $data["email"] = $email;
        $data["password"] = $passwordHash;
        $this->user_database->insert("user", $data);  
        return true;
    }

    public function getUserInfo($id){
        $this->userInfo = $this->user_database->select("SELECT `user_id`, f_name, l_name, gender, email, avatar FROM user WHERE `user_id` = $id", false)["data"];
    }

}