<?php

namespace controllers;
use system\Controller;
use models\User;

class Chat extends Controller {
    public $user;
    public function __construct(){
        parent::__construct();
        $this->user = new User;
    }

    public function conversations($to_id){
        $this->view->target = $to_id;
        $from_id = $_SESSION["id"];
        $selectedData = $this->user->db->select("SELECT m.from_id, m.to_id, m.body, u2.f_name, u2.l_name, u2.avatar FROM messages as m LEFT JOIN user as u ON m.from_id = u.user_id LEFT JOIN user as u2 ON m.to_id=u2.user_id WHERE (m.from_id = $from_id AND m.to_id = $to_id) OR (m.from_id = $to_id AND m. to_id = $from_id) ORDER BY date DESC");
        if($selectedData){
            $this->view->messages = $selectedData["data"];
            $this->user->db->update("messages", ["seen"=>true]);
        }
        $this->view->render("chat");
    }

    public function getMessages($from_id, $to_id){
        
    }

    public function sendMessage(){
        $from_id = $_SESSION["id"];
        $to_id = $_POST["to_id"];
        $message = $_POST["message"];
        return $this->sendMessageHelper($from_id, $to_id, $message);
    }

    public function sendMessageHelper($from_id, $to_id, $message){
        // $user = new User;
        $data = [
            "from_id" => $from_id,
            "to_id" => $to_id,
            "body" => $message

        ];
        $result = $this->user->db->insert("messages", $data);
        $response = [
            "message" => "after entering"
        ];
        echo json_encode($response);
    }


}