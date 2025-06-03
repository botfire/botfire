<?php
namespace Botfire\TraitMethods;

trait StartTimestampTrait
{
    /**
     * Start timestamp for the video in the message
     * @param int $start_timestamp
     * @return static
     */
    public function startTimestamp(int $start_timestamp){
        $this->data['start_timestamp'] = $start_timestamp;
        return $this;
    }
}