<?php
namespace Botfire\TraitMethods;
trait MessageThreadIdTrait
{
    /**
     * Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param int $message_thread_id
     * @return static
     */
    public function messageThreadId(int $message_thread_id)
    {
        $this->data['message_thread_id'] = $message_thread_id;
        return $this;
    }
}