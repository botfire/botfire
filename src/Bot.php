<?php
namespace Botfire;

class Bot {
    private static $instance = null;
    private static $token = '';
    private $message = null;


    public function __call($method, $arguments) {
        $params = $arguments[0] ?? [];
        return $this->request($method, $params);
    }

    public static function setWebhook($url = null) {
        $bot = self::getInstance();
        return $bot->request('setWebhook', ['url' => $url]);
    }



    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function setToken($token) {
        self::$token = $token;
        return self::getInstance();
    }

    public static function getToken(){
        return self::$token;
    }

    public static function message() {
        $bot = self::getInstance();
        if ($bot->message === null) {
            $bot->message = new Message(json_decode(file_get_contents('php://input'), true));
        }
        return $bot->message;
    }

    public static function new() {
        return new Message([]);
    }

    public function request($method, $params = []) {
        return TelegramApi::request(self::$token, $method, $params);
    }
}