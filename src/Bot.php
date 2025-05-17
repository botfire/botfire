<?php
namespace Botfire;

class Bot {
    private static $instance = null;
    private static $token = '';
    private $message = null;
    private $callback = null;


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

    public static function getInput(){
        return json_decode(file_get_contents('php://input'), true);
    }

    public static function isCallbackQuery($input = null){ 
        $bot = self::initInputMessage();
        return $bot->callback===null?false:true;
    }

    private static function initInputMessage(){
        $bot = self::getInstance();

        if ($bot->message === null) {

            $input = self::getInput();

            if(isset($input[Message::TYPE_CALLBACK_QUERY])){
                $message = ['message' => $input[Message::TYPE_CALLBACK_QUERY]['message']];
                unset($input[Message::TYPE_CALLBACK_QUERY]['message']);
                $callback = $input[Message::TYPE_CALLBACK_QUERY];

                $bot->message = new Message($message);
                $bot->callback = new Callback($callback);
            }
            else{
                $bot->message = new Message($input);
                $bot->callback = null;
            }

        }

        return $bot;
    }

    public static function message() {
        $bot = self::initInputMessage();
        return $bot->message;
    }

    public static function new() {
        $bot = new self();
        $bot->message =  new Message(self::getInput());
        $chat = $bot->message()->chat()->asArray();
        return new Message(['message' => ['chat' => $chat]]);
    }


    public static function callback(){
        $bot = self::getInstance();
        return $bot->callback;
    }

    public function request($method, $params = []) {
        file_put_contents(__DIR__.'/request.log', "method:$method");
        return TelegramApi::request(self::$token, $method, $params);
    }
}