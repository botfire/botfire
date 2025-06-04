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

    const TYPE_MESSAGE = 'message';
    const TYPE_EDITED_MESSAGE = 'edited_message';
    const TYPE_CHANNEL_POST = 'channel_post';
    const TYPE_EDITED_CHANNEL_POST = 'edited_channel_post';
    const TYPE_CALLBACK_QUERY = 'callback_query';
    const TYPE_BUSINESS_MESSAGE = 'business_message';
    const TYPE_EDITED_BUSINESS_MESSAGE = 'edited_business_message';



    const CONTENT_TEXT = 'text';
    const CONTENT_PHOTO = 'photo';
    const CONTENT_VIDEO = 'video';
    const CONTENT_AUDIO = 'audio';
    const CONTENT_DOCUMENT = 'document';
    const CONTENT_STICKER = 'sticker';
    const CONTENT_ANIMATION = 'animation';
    const CONTENT_LOCATION = 'location';
    const CONTENT_CONTACT = 'contact';
    const CONTENT_VOICE = 'voice';
    const CONTENT_POLL = 'poll';




    public function contentType()
    {
        $parse = Bot::getParser();

        if ($parse->hasMessage()) {
            foreach (['text', 'photo', 'video', 'audio', 'voice', 'sticker', 'animation', 'location', 'contact', 'poll', 'document'] as $type) {
                if (isset($parse->getMessageBody()['message'][$type])) {
                    return $type;
                }
            }
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
            return new GetMessage(['message'=>$this->data['message']['reply_to_message']]);
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

