<?php
namespace Botfire\TraitMethods;

trait InlineMessageIdTrait
{
    /**
     * VRequired if chat_id and message_id are not specified. Identifier of the inline message
     * @param string $inline_message_id
     * @return static
     */
    public function inlineMessageId(string $inline_message_id){
        $this->data['inline_message_id'] = $inline_message_id;
        return $this;
    }
}