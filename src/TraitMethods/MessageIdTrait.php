<?php
namespace Botfire\TraitMethods;

trait MessageIdTrait
{

    /**
     * Unique identifier for the target message, or the identifier of a message thread (topic) in a forum supergroup or channel
     * @param int $message_id
     */
    public function messageId(int $message_id){
        $this->data['message_id'] = $message_id;
        return $this;
    }
}