<?php

namespace controllers;

use helpers\FlashHelper;
use system\Controller;
use models\User;

class Profile extends Controller{
    public $user;
    public function __construct(){
        
        if(!isset($_SESSION["id"])){
            header("Location: /");
        }
        parent:: __construct();
        $this->user = new User;
    }
    
    public function index(){
        $this->userInfo($_SESSION["id"]);
        $this->view->user = $this->user;
        $this->view->render("profile");
    }
    
    public function profile(){
        return $this->index();
    }

    public function avatar(){

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $target_dir = "profile-pictures/";
            $target_file = $target_dir.basename($_FILES["image"]["name"]);
            $isUploaded=1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $target_file = $target_dir.basename((microtime(true)*10000).".".$imageFileType);
            if(isset($_POST["image"])){
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check === false){
                FlashHelper::setFlash("imageErr", "File is not an image.");
                $isUploaded = 0;
                }
                else{
                    FlashHelper::setFlash("imageErr", "File is an image.");
                }
            }
            if (file_exists($target_file)){
                FlashHelper::setFlash("imageErr", "Sorry, file already exists.");
                $isUploaded = 0;
            }
            if ($_FILES["image"]["size"] > 200000){
                FlashHelper::setFlash("imageErr", "Sorry, your file is too large.");
                $isUploaded = 0;
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
                FlashHelper::setFlash("imageErr", "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                $isUploaded = 0;
            }

            if ($isUploaded == 0){
                FlashHelper::setFlash("imageErr", "Sorry, your file was not uploaded.");
            }
            else{
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                FlashHelper::setFlash("imageErr", "uploaded file".$target_file);
                $target_id = $_SESSION['id'];
                $this->user->setAvatar($target_id, $target_file);
                header("Location: /profile");
                    echo "The file ".basename($_FILES["image"]["name"])." has been uploaded.";
                }
                else {
                    FlashHelper::setFlash("imageErr", "Sorry, there was an error uploading your file.");
                }
            }
            
        }
    }

    public function friends(){
        $this->userInfo($_SESSION["id"]);
        $this->user->getFriends($_SESSION["id"]);
        $this->view->user = $this->user;
        $this->view->render("friends");
    }

    public function user($id){
        $this->userInfo($id);
        $this->view->user = $this->user;
        $this->view->render("profile");
    }

    public function userInfo($id){
        return $this->user->getUserInfo($id);
    }
}