<?php

namespace models;
use system\Model;

class Message extends Model {

    public function sendMessage($message){
        $this->db->insert("messages", $message);
    }

    public function getMessage($from_id, $to_id){
        return $this->db->select(
            "SELECT m.from_id, m.to_id, m.body, m.seen, m.date, u.avatar 
            FROM messages as m INNER JOIN user as u ON m.from_id = u.id 
            WHERE (from_id = $from_id AND to_id = $to_id) OR (from_id = $to_id AND to_id = $from_id)
            ORDER BY date DESC"
            ,true);
    }

    public function seen($msgid){
        $this->db->update("messages", ["seen" => true], "`id` = $msgid");
    }
}