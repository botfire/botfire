<?php
namespace Botfire;

use Botfire\Models\Audio;
use Botfire\Models\AudioOption;
use Botfire\Models\AudioResult;
use Botfire\Models\Document;
use Botfire\Models\Message;
use Botfire\Models\Photo;
use Botfire\Models\User;
use Botfire\Models\Chat;
use Botfire\Models\PhotoArray;
use Botfire\Models\Video;
use Botfire\Models\VideoNote;
use Botfire\Models\Voice;



class NewMessage
{
    private $data;

    private $sendMethod = '';

    private $sendParams = [];


    public function __construct($data)
    {
        $this->data = $data;
    }



    private function makeMethodName($type, $prefix = 'send')
    {
        $method = $prefix;

        $type = ucfirst($type);

        if ($type == 'Text') {
            $method .= 'Message';
        } else {
            $method .= $type;
        }

        return $method;
    }

    // public function messageId()
    // {
    //     return $this->data['message']['message_id'] ?? null;
    // }


    public function chat()
    {
        return new Chat($this->data['message']['chat'] ?? []);
    }


    /**
     * Use this method to send text messages.
     * @param mixed $text
     */
    public function text(Message|string $text)
    {
        if ($text instanceof Message) {
            $text->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['text'] = $text;
        }

        $this->sendMethod = 'message';

        return $this;

    }


    /**
     * Use this method to send photos.
     * On success, the sent Message is returned.
     * @param mixed $photo
     * @return NewMessage|PhotoArray
     */
    public function photo($photo = null)
    {
        if ($photo instanceof Photo) {
            $photo->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['voice'] = $photo;
        }

        $this->sendMethod = 'voice';

        return $this;
    }



    /**
     * Use this method to send audio files, 
     * if you want Telegram clients to display the file as a playable voice message.
     * For this to work, your audio must be in an .OGG file encoded with OPUS, or in .MP3 format, or in .M4A format (other formats may be sent as Audio or Document).
     * On success, the sent Message is returned.
     * Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     * 
     * @param \Botfire\Models\Voice|string $voice
     * @return static
     */
    public function voice(Voice|string $voice)
    {
        if ($voice instanceof Voice) {
            $voice->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['voice'] = $voice;
        }

        $this->sendMethod = 'voice';

        return $this;
    }


    /**
     * Use this method to send audio files,
     * if you want Telegram clients to display them in the music player.
     * Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     * 
     * For sending voice messages, use the voice method instead.
     * 
     * @param \Botfire\Models\Audio|string $audio
     * @return static
     */
    public function audio(Audio|string $audio)
    {

        if ($audio instanceof Audio) {
            $audio->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['audio'] = $audio;
        }

        $this->sendMethod = 'audio';

        return $this;
    }


    /**
     * Use this method to send general files.
     * On success, the sent Message is returned.
     * Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     * @param \Botfire\Models\Document|string $document
     * @return static
     */
    public function document(Document|string $document)
    {

        if ($document instanceof Document) {
            $document->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['document'] = $document;
        }

        $this->sendMethod = 'document';

        return $this;
    }


    /**
     * Use this method to send video files,
     * Telegram clients support MPEG4 videos (other formats may be sent as Document).
     * On success, the sent Message is returned.
     * Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     * @param \Botfire\Models\Video|string $video
     * @return static
     */
    public function video(Video|string $video)
    {
        if ($video instanceof Video) {
            $video->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['video'] = $video;
        }

        $this->sendMethod = 'video';

        return $this;
    }

    public function videoNote(VideoNote|string $video)
    {
        if ($video instanceof VideoNote) {
            $video->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['video_note'] = $video;
        }

        $this->sendMethod = 'videoNote';

        return $this;
    }




    /**
     * @param string|int $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     */
    public function send(string|int $chat_id = null)
    {

        if(empty($this->sendParams['chat_id'])){
            $this->sendParams['chat_id'] = $chat_id ?? $this->chat()->id();
        }
         
        file_put_contents(__DIR__ . '/send.log', "sendMethod : " . $this->sendMethod . "  make:" . $this->makeMethodName($this->sendMethod));
        return Bot::request($this->makeMethodName($this->sendMethod), $this->sendParams);
    }


    // public function edit($message_id = null)
    // {
    //     $params = $this->sendParams;
    //     $params['chat_id'] = $this->chat()->id();
    //     $params['message_id'] = $message_id ?? $this->messageId();
    //     return Bot::getInstance()->request('editMessageText', $params);
    // }

    // public function delete($message_id = null)
    // {
    //     $params = [
    //         'chat_id' => $this->chat()->id(),
    //         'message_id' => $message_id ?? $this->messageId()
    //     ];
    //     return Bot::getInstance()->request('deleteMessage', $params);
    // }

    // public function replyMarkup($keyboard)
    // {
    //     $this->sendParams['reply_markup'] = $keyboard->toArray();
    //     return $this;
    // }
}

