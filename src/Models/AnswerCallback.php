<?php

namespace Botfire\Models;

use Botfire\Bot;

class AnswerCallback
{
    protected $data = [];


    /**
     * Unique identifier for the query to be answered
     * @param string $callbackQueryId
     * @return $this
     */
    public function callbackQueryId(string $callbackQueryId)
    {
        $this->data['callback_query_id'] = $callbackQueryId;
        return $this;
    }



    /**
     * If True, an alert will be shown by the client instead of a notification at the top of the chat screen.
     * Defaults to false.
     * 
     * @param bool $showAlert
     * @return $this
     */
    public function showAlert(bool $showAlert)
    {
        $this->data['show_alert'] = $showAlert;
        return $this;
    }


    /**
     * Text of the notification.
     * If not specified, nothing will be shown to the user, 0-200 characters
     * @param string $text
     * @return $this
     */
    public function text(string $text)
    {
        $this->data['text'] = $text;
        return $this;
    }


    /**
     * URL that will be opened by the user's client.
     * If you have created a Game and accepted the conditions via @BotFather, specify the URL that opens your game - note that this will only work if the query comes from a callback_game button.
     * 
     * @param string $url
     * @return $this
     */
    public function url(string $url)
    {
        $this->data['url'] = $url;
        return $this;
    }


    /**
     * The maximum amount of time in seconds that the result of the callback query may be cached client-side.
     * Telegram apps will support caching starting in version 3.14. Defaults to 0.
     * @param int $time
     * @return $this
     */
    public function cacheTime(int $time)
    {
        $this->data['cache_time'] = $time;
        return $this;
    }


    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     * The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
     * 
     */
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
