<?php
namespace Botfire;

use Botfire\Models\User;
use Botfire\Models\Chat;
use Botfire\Models\PhotoArray;



class Message {
    private $data;

    private $sendMethod = '';

    private $sendParams = [];


    public function __construct($data) {
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
    const TYPE_POLL = 'poll';
    const TYPE_CALLBACK_QUERY = 'callback_query';
    const TYPE_MESSAGE = 'message';

    

    public function type() {
        if (isset($this->data['message'])) {
            foreach (['text', 'photo', 'video', 'audio', 'document', 'sticker', 'animation', 'location', 'contact', 'poll'] as $type) {
                if (isset($this->data['message'][$type])) {
                    return $type;
                }
            }
        }
        else if(isset($this->data['callback_query'])){
            return 'callback_query';
        }
        return null;
    }

     private function makeMethodName($type, $prefix = 'send'){
        $method = $prefix;

        $type = ucfirst($type);

        if($type == 'Text'){
            $method .= 'Message';
        }

        else{
            $method .=$type;
        }
        
        return $method;
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
            $this->sendParams['text'] = $text;
            $this->sendMethod = 'message';
            return $this;
        }
        return $this->data['message']['text'] ?? null;
    }

    public function photo($photo = null) {
        if ($photo !== null) {
            $this->sendParams['photo'] = $photo;
            $this->sendMethod = 'photo';
            return $this;
        }

        $photoOb = new PhotoArray($this->data['message']['photo'] ?? []);
        $this->sendParams['photo'] = $photoOb->last()->getFileId();
        return $photoOb;
    }


    public function caption($caption = null) {
        if ($caption !== null) {
            $this->sendParams['caption'] = $caption;
            return $this;
        }
        return $this->data['message']['caption'] ?? null;
    }

    

    public function send($chat_id = null) {
        $this->sendParams['chat_id'] = $chat_id ?? $this->chat()->id();
        file_put_contents(__DIR__.'/send.log', "sendMethod : ".$this->sendMethod."  make:".$this->makeMethodName($this->sendMethod));
        return Bot::getInstance()->request($this->makeMethodName($this->sendMethod) , $this->sendParams);
    }

    public function edit($message_id = null) {
        $params = $this->sendParams;
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
        $this->sendParams['reply_markup'] = $keyboard->toArray();
        return $this;
    }
}

