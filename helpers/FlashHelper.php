<?php

namespace helpers;

class FlashHelper{
    public static function setFlash($key, $value){
        $_SESSION['message'][$key] = $value;
    }

    public static function getFlash($key){
        if(isset($_SESSION['message'][$key])) {
            $message = $_SESSION['message'][$key];
            unset($_SESSION['message'][$key]);
            return $message;
        }
        return null;
    }
    
}