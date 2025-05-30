<?php
namespace Botfire;

use Botfire\Models\Audio;
use Botfire\Models\AudioOption;
use Botfire\Models\AudioResult;
use Botfire\Models\Document;
use Botfire\Models\User;
use Botfire\Models\Chat;
use Botfire\Models\PhotoArray;
use Botfire\Models\Video;
use Botfire\Models\Voice;



class Message
{
    private $data;

    private $sendMethod = '';

    private $sendParams = [];


    public function __construct($data)
    {
        $this->data = $data;
    }


    const TYPE_TEXT = 'text';
    const TYPE_PHOTO = 'photo';
    const TYPE_VIDEO = 'video';
    const TYPE_AUDIO = 'audio';
    const TYPE_DOCUMENT = 'document';
    const TYPE_STICKER = 'sticker';
    const TYPE_ANIMATION = 'animation';
    const TYPE_LOCATION = 'location';
    const TYPE_CONTACT = 'contact';
    const TYPE_VOICE = 'voice';
    const TYPE_POLL = 'poll';
    const TYPE_CALLBACK_QUERY = 'callback_query';
    const TYPE_MESSAGE = 'message';



    public function type()
    {
        if (isset($this->data['message'])) {
            foreach (['text', 'photo', 'video', 'audio', 'voice', 'sticker', 'animation', 'location', 'contact', 'poll', 'document'] as $type) {
                if (isset($this->data['message'][$type])) {
                    return $type;
                }
            }
        } else if (isset($this->data['callback_query'])) {
            return 'callback_query';
        }
        return null;
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

    public function messageId()
    {
        return $this->data['message']['message_id'] ?? null;
    }

    public function from()
    {
        return new User($this->data['message']['from'] ?? []);
    }

    public function chat()
    {
        return new Chat($this->data['message']['chat'] ?? []);
    }

    public function text($text = null)
    {
        if ($text !== null) {
            $this->sendParams['text'] = $text;
            $this->sendMethod = 'message';
            return $this;
        }
        return $this->data['message']['text'] ?? null;
    }

    public function photo($photo = null)
    {
        if ($photo !== null) {
            $this->sendParams['photo'] = $photo;
            $this->sendMethod = 'photo';
            return $this;
        }

        $photoArray = new PhotoArray($this->data['message']['photo'] ?? []);
        return $photoArray;
    }



    /**
     * Use this method to send audio files, 
     * if you want Telegram clients to display the file as a playable voice message.
     * For this to work, your audio must be in an .OGG file encoded with OPUS, or in .MP3 format, or in .M4A format (other formats may be sent as Audio or Document).
     * On success, the sent Message is returned.
     * Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     * 
     * @param \Botfire\Models\Voice|string $voice
     * @return Message|Voice
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


    public function video(Video|string $video = null)
    {
        if ($video instanceof Video) {
            $video->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['document'] = $video;
        }

        $this->sendMethod = 'document';

        return $this;
    }


    public function caption($caption = null)
    {
        if ($caption !== null) {
            $this->sendParams['caption'] = $caption;
            return $this;
        }
        return $this->data['message']['caption'] ?? null;
    }


    public function thumbnail($thumbnail)
    {
        $this->sendParams['thumbnail'] = $thumbnail;
        return $this;
    }



    /**
     * Send Message Or Action
     * @param string|int $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     */
    public function send(string|int $chat_id = null)
    {

        $this->sendParams['chat_id'] = $chat_id ?? $this->chat()->id();
        file_put_contents(__DIR__ . '/send.log', "sendMethod : " . $this->sendMethod . "  make:" . $this->makeMethodName($this->sendMethod));
        return Bot::getInstance()->request($this->makeMethodName($this->sendMethod), $this->sendParams);
    }

    public function edit($message_id = null)
    {
        $params = $this->sendParams;
        $params['chat_id'] = $this->chat()->id();
        $params['message_id'] = $message_id ?? $this->messageId();
        return Bot::getInstance()->request('editMessageText', $params);
    }

    public function delete($message_id = null)
    {
        $params = [
            'chat_id' => $this->chat()->id(),
            'message_id' => $message_id ?? $this->messageId()
        ];
        return Bot::getInstance()->request('deleteMessage', $params);
    }

    public function replyMarkup($keyboard)
    {
        $this->sendParams['reply_markup'] = $keyboard->toArray();
        return $this;
    }
}

