<?php
namespace Botfire\Models;




class Option
{
    
    protected $data = [];







    /**
     * Required if inline_message_id is not specified.
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|string $chat_id
     * @return static
     */
    public function chatId(int|string $chat_id)
    {
        $this->data['chat_id'] = $chat_id;
        return $this;
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