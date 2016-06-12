<?php

/**
 * Created by PhpStorm.
 * User: Angga
 * Date: 12/06/2016
 * Time: 10.12
 */
class RegisterController
{
    public function check_email($email){
        if($email == "anggadarkprince@gmail.com"){
            return false;
        }
        return true;
    }

    public function send_email($email, $name, $token){
        return "Message Sent!";
    }
    
    public function register($data){
        $_SESSION["status"] = "success";
    }

}