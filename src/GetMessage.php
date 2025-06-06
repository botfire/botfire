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



    /**
     * Check if the message is valid.
     * @return bool
     */
    public function isValid(): bool
    {
        return isset($this->data['message_id']) && isset($this->data['from']);
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
    public function getContentType()
    {
        foreach ([self::TYPE_TEXT, self::TYPE_PHOTO, self::TYPE_VIDEO, self::TYPE_AUDIO, self::TYPE_VOICE, self::TYPE_STICKER, self::TYPE_ANIMATION, self::TYPE_LOCATION, self::TYPE_CONTACT, self::TYPE_POLL, self::TYPE_DOCUMENT] as $type) {
            if (isset($this->data[$type])) {
                return $type;
            }
        }

        return null;
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
     * Returns the unique identifier for this message.
     */
    public function getMessageId()
    {
        return $this->data['message_id'] ?? null;
    }

    /**
     * Returns the date the message was sent in Unix time.
     * @return int|null
     */
    public function getDate()
    {
        return $this->data['date'] ?? null;
    }

    public function getFrom()
    {
        return new User($this->data['from'] ?? []);
    }

    public function getChat()
    {
        return new Chat($this->data['chat'] ?? []);
    }


    /**
     * Returns the message that this message is replying to, if any.
     * @return GetMessage|null
     */
    public function getReplyToMessage(): GetMessage|null
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
    public function getText(): string|null
    {

        return $this->data['text'] ?? null;
    }


    /**
     * Returns the caption of the message, if any.
     * This method returns the caption of the message.
     * If the message is not a media message with a caption, it returns null.
     * @return string|null
     */
    public function getCaption()
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
    public function getQuote()
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
        $message_id = $this->getMessageId();
        $chat_id = $this->getChat()->getId();
        return Bot::deleteMessage($message_id, $chat_id);
    }


}

