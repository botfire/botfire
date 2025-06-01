<?php
namespace Botfire;

use Botfire\Models\Audio;
use Botfire\Models\CopyMessage;
use Botfire\Models\CopyMessages;
use Botfire\Models\Document;
use Botfire\Models\Message;
use Botfire\Models\Photo;
use Botfire\Models\Video;
use Botfire\Models\VideoNote;
use Botfire\Models\Voice;
use Botfire\MessageParser;
use Botfire\GetMessage;
use Botfire\GetCallback;

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
        return Bot::request('setWebhook', ['url' => $url]);
    }



    public static function getParser()
    {
        if (self::$parser === null && self::getInput() != null) {
            self::$parser = new MessageParser(self::getInput());

        }

        return self::$parser;
    }

    public static function setToken($token)
    {
        self::$token = $token;
        return self::getParser();
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
        $bot = self::getParser();
        return $bot->hasCallback();
    }


    public static function getMessage()
    {
        $bot = self::getParser();
        return new GetMessage($bot->getMessageBody());
    }


    public static function new()
    {
        $parse = self::getParser();
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



    /**
     * Use this method to copy messages of any kind.
     * Service messages, paid media messages, giveaway messages, giveaway winners messages, and invoice messages can't be copied
     * A quiz poll can be copied only if the value of the field correct_option_id is known to the bot.
     * The method is analogous to the method forwardMessage, but the copied message doesn't have a link to the original message.
     * Returns the MessageId of the sent message on success.
     * @param CopyMessage $copy_message
     */
    public static function copyMessage(CopyMessage $copy_message){
        $bot = self::new();
        return $bot->copyMessage($copy_message)->send();
    }


    /**
     * Use this method to copy messages of any kind.
     * If some of the specified messages can't be found or copied, they are skipped.
     * Service messages, paid media messages, giveaway messages, giveaway winners messages, and invoice messages can't be copied
     * A quiz poll can be copied only if the value of the field correct_option_id is known to the bot.
     * The method is analogous to the method forwardMessages, but the copied messages don't have a link to the original message.
     * Album grouping is kept for copied messages.
     * On success, an array of MessageId of the sent messages is returned.
     * @param CopyMessages $copy_messages
     */
    public static function copyMessages(CopyMessages $copy_messages){
        $bot = self::new();
        return $bot->copyMessages($copy_messages)->send();
    }

    public static function getCallback():GetCallback
    {
        $parser = self::getParser();
        return new GetCallback($parser->getCallbackBody());
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