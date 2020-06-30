<?php

namespace models;
use system\Model;

class Message extends Model {

    public function sendMessage($message){
        $this->db->insert("messages", $message);
    }

    public function getMessage($from_id, $to_id){
        return $this->db->select(
            "SELECT m.from_id, m.to_id, m.body, m.id, m.seen, m.date, u.f_name, u.avatar
            FROM messages as m LEFT JOIN user as u ON m.from_id = u.user_id 
            WHERE (from_id = $from_id AND to_id = $to_id) OR (from_id = $to_id AND to_id = $from_id)
            ORDER BY date ASC"
            ,true);
    }

    public function getNewMessages($from_id, $to_id, $lastId){
        return $this->db->select(
            "SELECT m.from_id, m.to_id, m.body, m.id, m.seen, m.date, u.f_name, u.avatar
            FROM messages as m LEFT JOIN user as u ON m.from_id = u.user_id 
            WHERE ((from_id = $from_id AND to_id = $to_id) OR (from_id = $to_id AND to_id = $from_id)) 
            AND m.id > $lastId
            ORDER BY date ASC"
            ,true);
    }

    public function seen($from_id, $to_id){
        return $this->db->update("messages", ["seen" => true], "(from_id = $from_id AND to_id = $to_id) OR (from_id = $to_id AND to_id = $from_id)");
    }

    public function getHistory($current_user_id){
        return $this->db->select("SELECT DISTINCT results.id, results.avatar, results.f_name 
                                    FROM (
                                    SELECT DISTINCT m.to_id as id, u.avatar, u.f_name
                                    FROM messages as m 
                                    LEFT JOIN user as u ON u.user_id=m.to_id 
                                    WHERE from_id = $current_user_id
                                    UNION
                                    SELECT DISTINCT m.from_id as id, u.avatar, u.f_name
                                    FROM messages as m 
                                    LEFT JOIN user as u ON u.user_id=m.from_id 
                                    WHERE to_id = $current_user_id) as results");
    }
}