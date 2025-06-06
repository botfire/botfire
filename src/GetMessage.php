<?php
namespace Botfire;
use Botfire\Models\TextQuote;
use Botfire\Models\User;
use Botfire\Models\Chat;

class GetMessage
{
    private $data;


    public function __construct($data)
    {
        $this->data = $data;
    }




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



    /**
     * Check if the message is valid.
     * @return bool
     */
    public function isValid(): bool
    {
        return isset($this->data['message_id']) && isset($this->data['chat']);
    }


    /**
     * Returns the type of the message.
     * Possible values are:
     * - 'text'
     * - 'photo'
     * - 'video'
     * - 'audio'
     * - 'voice'
     * - 'sticker'
     * - 'animation'
     * - 'document'
     * - 'location'
     * - 'contact'
     * - 'poll'
     * @return string|null
     */
    public function contentType()
    {
        foreach ([    self::CONTENT_TEXT,
        self::CONTENT_PHOTO,
        self::CONTENT_VIDEO,
        self::CONTENT_AUDIO,
        self::CONTENT_VOICE,
        self::CONTENT_STICKER,
        self::CONTENT_ANIMATION,
        self::CONTENT_LOCATION,
        self::CONTENT_CONTACT,
        self::CONTENT_POLL,
        self::CONTENT_DOCUMENT
        ] as $type) {
            if (isset($this->data[$type])) {
                return $type;
            }
        }
        
        return null;
    }


    /**
     * Check if the event is a callback query.
     * @return bool
     */
    public function isCallbackQuery(): bool
    {
        return Bot::getEvent()->name() === GetEvent::TYPE_CALLBACK_QUERY;
    }


    /**
     * Check if the event is an edited message.
     * @return bool
     */
    public function isEditedMessage(): bool
    {
        return Bot::getEvent()->name() === GetEvent::TYPE_EDITED_MESSAGE;
    }


    /**
     * Check if the event is an edited channel post.
     * @return bool
     */
    public function isEditedChannelPost(): bool
    {
        return Bot::getEvent()->name() === GetEvent::TYPE_EDITED_CHANNEL_POST;
    }
   
    /**
     * Check if the event is a message.
     * This method checks if the event is a message type and if the message is valid.
     * @return bool
     */
    public function isMessage(): bool
    {
        return Bot::getEvent()->name() === GetEvent::TYPE_MESSAGE && $this->isValid();
    }


    /**
     * Check if the event is a channel post.
     * @return bool
     */
    public function isChannelPost(): bool
    {
        return Bot::getEvent()->name() === GetEvent::TYPE_CHANNEL_POST;
    }


    /**
     * Check if the event is a business message.
     * @return bool
     */
    public function isBusinessMessage(): bool
    {
        return Bot::getEvent()->name() === GetEvent::TYPE_BUSINESS_MESSAGE;
    }


    /**
     * Check if the event is an edited business message.
     * @return bool
     */
    public function isEditedBusinessMessage(): bool
    {
        return Bot::getEvent()->name() === GetEvent::TYPE_EDITED_BUSINESS_MESSAGE;
    }


    /**
     * Returns the unique identifier for this message.
     */
    public function messageId()
    {
        return $this->data['message_id'] ?? null;
    }

    /**
     * Returns the date the message was sent in Unix time.
     * @return int|null
     */
    public function date()
    {
        return $this->data['date'] ?? null;
    }

    public function from()
    {
        return new User($this->data['from'] ?? []);
    }

    public function chat()
    {
        return new Chat($this->data['chat'] ?? []);
    }


    /**
     * Check if the message is a reply to another message.
     * @return bool
     */
    public function isReply(): bool
    {
        return isset($this->data['reply_to_message']);
    }


    /**
     * Returns the message that this message is replying to, if any.
     * @return GetMessage|null
     */
    public function replyToMessage(): GetMessage|null
    {
        if ($this->isReply()) {
            return new GetMessage($this->data['reply_to_message']);
        }
        return null;
    }


    /**
     * Returns the text content of the message, if any.
     * This method returns the text content of the message.
     * If the message is not a text message, it returns null.
     * @return string|null
     */
    public function text(): string|null
    {

        return $this->data['text'] ?? null;
    }


    /**
     * Returns the caption of the message, if any.
     * This method returns the caption of the message.
     * If the message is not a media message with a caption, it returns null.
     * @return string|null
     */
    public function caption()
    {
        return $this->data['caption'] ?? null;
    }



    /**
     * Check if the message has a quote.
     * A quote is a text that is quoted in the message.
     * @return bool
     */
    public function hasQuote(): bool
    {
        return isset($this->data['quote']);
    }

    /**
     * Returns the quote of the message, if any.
     * This method returns an instance of TextQuote if the message has a quote.
     * If the message does not have a quote, it returns null.
     * @return TextQuote|null
     */
    public function quote()
    {
        return new TextQuote($this->data['quote']) ?? null;
    }




    /**
     * Deletes the message.
     * This method deletes the message from the chat.
     * @return bool
     */
    public function deleteThisMessage()
    {
        $message_id = $this->messageId();
        $chat_id = $this->chat()->getId();
        return Bot::deleteMessage($message_id, $chat_id);
    }


}

