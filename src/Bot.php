<?php
namespace Botfire;

use Botfire\Models\Audio;
use Botfire\Models\Document;
use Botfire\Models\Message;
use Botfire\Models\Photo;
use Botfire\Models\Video;
use Botfire\Models\VideoNote;
use Botfire\Models\Voice;
use Botfire\Message as GetMessage;

class Bot
{
    private static $instance = null;
    private static $token = '';
    private $message = null;
    private $callback = null;


    public function __call($method, $arguments)
    {
        $params = $arguments[0] ?? [];
        return $this->request($method, $params);
    }

    public static function setWebhook($url = null)
    {
        $bot = self::getInstance();
        return $bot->request('setWebhook', ['url' => $url]);
    }



    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function setToken($token)
    {
        self::$token = $token;
        return self::getInstance();
    }

    public static function getToken()
    {
        return self::$token;
    }

    public static function getInput()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public static function isCallbackQuery($input = null)
    {
        $bot = self::initInputMessage();
        return $bot->callback === null ? false : true;
    }

    private static function initInputMessage()
    {
        $bot = self::getInstance();

        if ($bot->message === null) {

            $input = self::getInput();

            if (isset($input[GetMessage::TYPE_CALLBACK_QUERY])) {
                $message = ['message' => $input[GetMessage::TYPE_CALLBACK_QUERY]['message']];
                unset($input[GetMessage::TYPE_CALLBACK_QUERY]['message']);
                $callback = $input[GetMessage::TYPE_CALLBACK_QUERY];

                $bot->message = new GetMessage($message);
                $bot->callback = new Callback($callback);
            } else {
                $bot->message = new GetMessage($input);
                $bot->callback = null;
            }

        }

        return $bot;
    }

    public static function message()
    {
        $bot = self::initInputMessage();
        return $bot->message;
    }

    public static function new()
    {
        $bot = new self();
        $bot->message = new Message(self::getInput());
        $chat = $bot->message()->chat()->asArray();
        return new NewMessage(['message' => ['chat' => $chat]]);
    }

    


    public static function sendVideoNote(VideoNote|string $videoNote){
        $bot = self::new();
        return $bot->videoNote($videoNote)->send();
    }

    public static function sendVideo(Video|string $video){
        $bot = self::new();
        return $bot->video($video)->send();
    }

    public static function sendPhoto(Photo|string $photo){
        $bot = self::new();
        return $bot->photo($photo)->send();
    }

    public static function sendVoice(Voice|string $voice){
        $bot = self::new();
        return $bot->voice($voice)->send();
    }

    public static function sendAudio(Audio|string $audio){
        $bot = self::new();
        return $bot->audio($audio)->send();
    }


    public static function sendDocument(Document|string $document){
        $bot = self::new();
        return $bot->document($document)->send();
    }


    public static function sendMessage(Message|string $text){
        $bot = self::new();
        return $bot->text($text)->send();
    }


    



    public static function callback()
    {
        $bot = self::getInstance();
        return $bot->callback;
    }

    public function request($method, $params = [])
    {
        return TelegramApi::request(self::$token, $method, $params);
    }

    public function requestFile($file_path)
    {
        return TelegramApi::requestFile(self::$token, $file_path);
    }

    public static function inputFile($path)
    {
        return new \CURLFile(realpath($path));
    }

}