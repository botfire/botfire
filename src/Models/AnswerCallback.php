<?php

namespace Botfire\Models;

use Botfire\Bot;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\InlineMessageIdTrait;
use Botfire\TraitMethods\MessageIdTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;

class AnswerCallback extends Option
{
    protected $data = [];

    public function callbackQueryId(string $callbackQueryId)
    {
        $this->data['callback_query_id'] = $callbackQueryId;
        return $this;
    }


    public function showAlert(bool $showAlert)
    {
        $this->data['show_alert'] = $showAlert;
        return $this;
    }


    public function text(string $text)
    {
        $this->data['text'] = $text;
        return $this;
    }

    public function url(string $url)
    {
        $this->data['url'] = $url;
        return $this;
    }


    public function cacheTime(int $time)
    {
        $this->data['cache_time'] = $time;
        return $this;
    }


    public function send(){
        return Bot::answerCallback($this);
    }

     /**
     * 
     * @param mixed $data
     * @return void
     */
    public function appendToSendParams(&$data)
    {
        foreach ($this->data as $key => $value) {
            $data[$key] = $value;
        }
    }



    /**
     * Convert the data to an array
     * @return array<int|string>
     */
    public function toArray(){
        return $this->data;
    }
}
