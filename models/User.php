<?php

namespace models;
use system\Model;

class User extends Model{
    public $userInfo;
	public function login($email, $password){
        $email = $this->db->escapeString($email);
        $passwordHash = md5($password);
        $query = "SELECT `user_id` FROM user WHERE `password` = '$passwordHash' AND email = '$email'";
        $getUser = $this->db->select($query, false);
        return $getUser;
    }


    public function registration($firstName, $lastName, $gender, $email, $password){
        $email = $this->db->escapeString($email);
        $passwordHash = md5($password);
        $data = [
            "f_name" => $firstName,
            "l_name" => $lastName,
            "gender" => $gender,
            "email" => $email,
            "password" => $passwordHash
        ];
        $inserted = $this->db->insert("user", $data);  
        return $inserted;
    }

    public function getUserInfo($id){
        $selectUser = $this->db->select("SELECT `user_id`, f_name, l_name, gender, email, avatar FROM user WHERE `user_id` = $id", false);
        $this->userInfo = $selectUser["data"];
    }

    public function getFriends($id){
        $selectFriends = $this->db->select(("SELECT `user_id`, f_name, l_name, avatar FROM user WHERE `user_id`<>$id"));
        $this->friendList = $selectFriends["data"];
    }

}