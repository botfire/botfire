<?php
namespace Botfire\Models;

trait OptionMessageId
{

    protected $data = [];





    /**
     * Required if inline_message_id is not specified.
     * Identifier of the message to edit
     * @param int $message_id
     */
    public function messageId(int $message_id)
    {
        $this->data['message_id'] = $message_id;
        return $this;
    }





    /**
     * Required if chat_id and message_id are not specified.
     * Identifier of the inline message
     * @param string $inline_message_id
     */
    public function inlineMessageId(string $inline_message_id)
    {
        $this->data['inline_message_id'] = $inline_message_id;
        return $this;
    }


}