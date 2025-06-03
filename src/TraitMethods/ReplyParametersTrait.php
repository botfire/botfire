<?php
namespace Botfire\TraitMethods;

trait ReplyParametersTrait
{
    /**
     * Parameters for the reply, such as message effect ID or business connection ID.
     * @param mixed $reply_parameters
     * @return static
     */
    public function replyParameters($reply_parameters)
    {
        $this->data['reply_parameters'] = $reply_parameters;
        return $this;
    }
}