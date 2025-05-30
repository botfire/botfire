<?php
namespace Botfire;

use Botfire\Models\Audio;
use Botfire\Models\Document;
use Botfire\Models\Message;
use Botfire\Models\Photo;
use Botfire\Models\Video;
use Botfire\Models\VideoNote;
use Botfire\Models\Voice;
use Botfire\GetMessage;

use Botfire\MessageParser;

class Bot
{

    private static ?MessageParser $parser = null;


    private static $instance = null;
    private static $token = '';



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
        if (self::$parser === null) {
            self::$parser = new MessageParser(self::getInput());

        }

        return self::$parser;

        // if (self::$instance === null) {
        //     self::$instance = new self();
        //     self::$instance->message = self::$parser->parse();
        //     // $input = self::getInput();
        //     // if (isset($input[GetMessage::TYPE_CALLBACK_QUERY])) {
        //     //     $callback = $input[GetMessage::TYPE_CALLBACK_QUERY];
        //     //     unset($input[GetMessage::TYPE_CALLBACK_QUERY]);
        //     //     self::$instance->callback = new Callback($callback);
        //     // } else {
        //     //     self::$instance->callback = null;
        //     // }
        // }

        // return self::$instance;
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

    public static function isCallbackQuery()
    {
        $bot = self::getInstance();
        return $bot->hasCallback();
    }

    // private static function initInputMessage()
    // {
    //     $bot = self::getInstance();

    //     // if ($bot->message === null) {

    //     //     $input = self::getInput();

    //     //     if (isset($input[GetMessage::TYPE_CALLBACK_QUERY])) {
    //     //         $message = ['message' => $input[GetMessage::TYPE_CALLBACK_QUERY]['message']];
    //     //         unset($input[GetMessage::TYPE_CALLBACK_QUERY]['message']);
    //     //         $callback = $input[GetMessage::TYPE_CALLBACK_QUERY];

    //     //         $bot->message = new GetMessage($message);
    //     //         $bot->callback = new Callback($callback);
    //     //     } else {
    //     //         $bot->message = new GetMessage($input);
    //     //         $bot->callback = null;
    //     //     }

    //     // }

    //     return $bot;
    // }



    public static function getMessage()
    {
        $bot = self::getInstance();
        return new GetMessage($bot->getMessageBody());
    }


    public static function new()
    {
        $parse = self::getInstance();
        $message = $parse->getMessageBody();
        $chat = $message['message']['chat'] ?? [];
        return new NewMessage(['message' => ['chat' => $chat]]);
    }




    public static function sendVideoNote(VideoNote|string $videoNote)
    {
        $bot = self::new();
        return $bot->videoNote($videoNote)->send();
    }


    /**
     * Use this method to send video files,
     * Telegram clients support MPEG4 videos (other formats may be sent as Document).
     * On success, the sent Message is returned.
     * Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     * 
     * @param \Botfire\Models\Video|string $video
     */
    public static function sendVideo(Video|string $video)
    {
        $bot = self::new();
        return $bot->video($video)->send();
    }


    /**
     * Use this method to send photos.
     * @param \Botfire\Models\Photo|string $photo
     */
    public static function sendPhoto(Photo|string $photo)
    {
        $bot = self::new();
        return $bot->photo($photo)->send();
    }


    /**
     * Use this method to send audio files, 
     * if you want Telegram clients to display the file as a playable voice message.
     * For this to work, your audio must be in an .OGG file encoded with OPUS, or in .MP3 format, or in .M4A format (other formats may be sent as Audio or Document).
     * On success, the sent Message is returned.
     * Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param \Botfire\Models\Voice|string $voice
     */
    public static function sendVoice(Voice|string $voice)
    {
        $bot = self::new();
        return $bot->voice($voice)->send();
    }


    /**
     * Use this method to send audio files,
     * if you want Telegram clients to display them in the music player.
     * Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     * 
     * @param \Botfire\Models\Audio|string $audio
     */
    public static function sendAudio(Audio|string $audio)
    {
        $bot = self::new();
        return $bot->audio($audio)->send();
    }


    /**
     * Use this method to send general files.
     * On success, the sent Message is returned.
     * Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     * 
     * @param \Botfire\Models\Document|string $document
     */
    public static function sendDocument(Document|string $document)
    {
        $bot = self::new();
        return $bot->document($document)->send();
    }


    /**
     * Use this method to send text messages.
     * @param \Botfire\Models\Message|string $text
     */
    public static function sendMessage(Message|string $text)
    {
        $bot = self::new();
        return $bot->text($text)->send();
    }






    public static function callback()
    {
        $bot = self::getInstance();
        return $bot->callback;
    }

    public static function request($method, $params = [])
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