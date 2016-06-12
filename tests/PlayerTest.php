<?php

require_once('tests/RegisterController.php');
//require_once('controllers/PlayerController.php');

/**
 * Created by PhpStorm.
 * User: Angga
 * Date: 12/06/2016
 * Time: 09.54
 */
class PlayerTest extends PHPUnit_Framework_TestCase
{
    private $player;

    public function setUp()
    {
        $this->player = new RegisterController();
    }

    public function tearDown()
    {
        $this->player = null;
    }

    public function testCheck_email()
    {
        $this->assertFalse($this->player->check_email("anggadarkprince@gmail.com"));
        $this->assertTrue($this->player->check_email("angga-ari@email.com"));
    }

    public function testSendEmail()
    {
        // expect string “Message Sent!”
        $name = "Angga Ari Wijaya";
        $email = "anggadarkprince@gmail.com";
        $token = "9582KFiug9jg06876iu6798";

        $result = $this->player->send_email($email, $name, $token);
        $this->assertEquals("Message Sent!", $result);
    }

    public function testRegistration()
    {
        // expect string “Message Sent!”
        $inputs = [
            "token" => "ahitr2987369ft82349723",
            "email" => "anggadarkprince@gmail.com",
            "name" => "Angga Ari Wijaya",
            "password" => "$3475299GIt8o7tg8%798t8%6875746",
            "state" => "pending"
        ];

        $result = $this->player->register($inputs);
        $this->assertEquals("success", $_SESSION["status"]);
    }
}
