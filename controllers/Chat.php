<?php

namespace controllers;
use system\Controller;
use models\User;
use models\Message;

class Chat extends Controller {
    public $user;
    public $message;
    public function __construct(){
        parent::__construct();
        $this->user = new User;
        $this->message = new Message;
    }

    public function index($to_id){
        $this->view->target = $to_id;
        $from_id = $_SESSION["id"];
        $selectedData = $this->message->getMessage($from_id, $to_id);
        if($selectedData){
            $this->view->messages = $selectedData["data"];
            // $this->message->seen();
        }
        $this->view->render("chat");
    }

    public function conversations($to_id){
        return $this->index($to_id);
    }

    public function sendMessage(){
        $from_id = $_SESSION["id"];
        $to_id = $_POST["to_id"];
        $message = $_POST["message"];
        return $this->sendMessageHelper($from_id, $to_id, $message);
    }

    public function sendMessageHelper($from_id, $to_id, $message){
        $data = [
            "from_id" => $from_id,
            "to_id" => $to_id,
            "body" => $message

        ];
        $this->user->db->insert("messages", $data);
        $response = [
            "message" => "after entering"
        ];
        echo json_encode($response);
    }


}