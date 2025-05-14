<?php
namespace Botfire;

class Message {
    private $data;
    private $newMessage = [];

    public function __construct($data) {
        $this->data = $data;
    }

    public function type() {
        if (isset($this->data['message'])) {
            foreach (['text', 'photo', 'video', 'audio', 'document', 'sticker', 'animation', 'location', 'contact', 'poll'] as $type) {
                if (isset($this->data['message'][$type])) {
                    return $type;
                }
            }
        }
        return null;
    }

    public function messageId() {
        return $this->data['message']['message_id'] ?? null;
    }

    public function from() {
        return new User($this->data['message']['from'] ?? []);
    }

    public function chat() {
        return new Chat($this->data['message']['chat'] ?? []);
    }

    public function text($text = null) {
        if ($text !== null) {
            $this->newMessage['text'] = $text;
            return $this;
        }
        return $this->data['message']['text'] ?? null;
    }

    public function photo() {
        return new PhotoArray($this->data['message']['photo'] ?? []);
    }

    public function send($chat_id = null) {
        $params = $this->newMessage ?: $this->data['message'];
        $params['chat_id'] = $chat_id ?? $this->chat()->id();
        return Bot::getInstance()->request('send' . ucfirst($this->type() ?: 'Message'), $params);
    }

    public function edit($message_id = null) {
        $params = $this->newMessage;
        $params['chat_id'] = $this->chat()->id();
        $params['message_id'] = $message_id ?? $this->messageId();
        return Bot::getInstance()->request('editMessageText', $params);
    }

    public function delete($message_id = null) {
        $params = [
            'chat_id' => $this->chat()->id(),
            'message_id' => $message_id ?? $this->messageId()
        ];
        return Bot::getInstance()->request('deleteMessage', $params);
    }

    public function replyMarkup($keyboard) {
        $this->newMessage['reply_markup'] = $keyboard->toArray();
        return $this;
    }
}

class User {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function id() {
        return $this->data['id'] ?? null;
    }

    public function isBot() {
        return $this->data['is_bot'] ?? false;
    }

    public function username() {
        return $this->data['username'] ?? null;
    }
}

class Chat {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function id() {
        return $this->data['id'] ?? null;
    }

    public function type() {
        return $this->data['type'] ?? null;
    }
}

class PhotoArray {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function first() {
        return new Photo($this->data[0] ?? []);
    }

    public function latest() {
        return new Photo(end($this->data) ?: []);
    }

    public function indexOf($index) {
        return new Photo($this->data[$index] ?? []);
    }

    public function count() {
        return count($this->data);
    }

    public function asArray() {
        return $this->data;
    }
}

class Photo {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function fileId() {
        return $this->data['file_id'] ?? null;
    }
}