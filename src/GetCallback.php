<?php
namespace Botfire;

use Botfire\Models\From;
use Botfire\Models\User;

class GetCallback
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Unique identifier for this query
     * @return string
     */
    public function getId(): string
    {
        return $this->data['id'] ?? null;
    }


    /**
     * Sender of the message with the callback button.
     * @return User
     */
    public function getFrom()
    {
        return new User($this->data['from'] ?? []);
    }


    /**
     * Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent.
     * Useful for high scores in games.
     * @return string
     */
    public function getChatInstance(): ?string
    {
        return $this->data['chat_instance'] ?? '';
    }


    /**
     * Optional.
     * Identifier of the message sent via the bot in inline mode, that originated the query.
     */
    public function getInlineMessageId(): ?string
    {
        return $this->data['inline_message_id'] ?? null;
    }


    /**
     * Optional.
     * Data associated with the callback button.
     * Be aware that the message originated the query can contain no callback buttons with this data.
     * @return string
     */
    public function getData(): string
    {
        return $this->data['data'] ?? '';
    }

    /**
     * Check if the callback query has a message.
     * @return bool
     */
    public function hasMessage(): bool
    {
        return isset($this->data['message']);
    }



    /**
     * Optional.
     * Message sent by the bot with the callback button that originated the query
     * @return GetMessage|null
     */
    public function getMessage(){
        if ($this->hasMessage()) {
            return new GetMessage($this->data['message']);
        }
        return null;
    }

}