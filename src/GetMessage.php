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



class GetMessage
{
    private $data;


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
        $parse = Bot::getParser();

        if ($parse->hasMessage()) {
            foreach (['text', 'photo', 'video', 'audio', 'voice', 'sticker', 'animation', 'location', 'contact', 'poll', 'document'] as $type) {
                if (isset($parse->getMessageBody()['message'][$type])) {
                    return $type;
                }
            }
        } else if ($parse->hasCallback()) {
            return 'callback_query';
        }
        return null;
    }





    public function messageId()
    {
        return $this->data['message']['message_id'] ?? null;
    }

    public function date()
    {
        return $this->data['message']['date'] ?? null;
    }

    public function from()
    {
        return new User($this->data['message']['from'] ?? []);
    }

    public function chat()
    {
        return new Chat($this->data['message']['chat'] ?? []);
    }





    public function isReply(): bool
    {
        return isset($this->data['message']['reply_to_message']);
    }


    /**
     * Returns the message that this message is replying to, if any.
     * @return GetMessage|null
     */
    public function replyToMessage(): GetMessage|null
    {
        if ($this->isReply()) {
            return new GetMessage($this->data['message']['reply_to_message']);
        }
        return null;
    }

    public function text(): string|null
    {

        return $this->data['message']['text'] ?? null;
    }


    public function caption()
    {
        return $this->data['message']['caption'] ?? null;
    }


    public function deleteThisMessage()
    {
        $message_id = $this->messageId();
        $chat_id = $this->chat()->getId();
        return Bot::deleteMessage($message_id, $chat_id);
    }


}

