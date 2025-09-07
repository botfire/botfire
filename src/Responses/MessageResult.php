<?php

namespace Botfire\Responses;

use \Botfire\Responses\Chat;
use \Botfire\Responses\From;


class MessageResult
{
    private int $messageId;
    private From $from;
    private Chat $chat;
    private int $date;

    public function __construct(array $data)
    {
        $this->messageId = $data['message_id'];
        $this->from = new From($data['from']);
        $this->chat = new Chat($data['chat']);
        $this->date = $data['date'];
    }

    public function getMessageId(): int
    {
        return $this->messageId;
    }

    public function getFrom(): From
    {
        return $this->from;
    }

    public function getChat(): Chat
    {
        return $this->chat;
    }

    public function getDate(): int
    {
        return $this->date;
    }
}