<?php
namespace Botfire\TraitMethods;

trait VideoStartTimestampTrait
{

    /**
     * New start timestamp for the copied video in the message
     * @param int $video_start_timestamp
     */
    public function videoStartTimestamp(int $video_start_timestamp){
        $this->data['video_start_timestamp'] = $video_start_timestamp;
        return $this;
    }
}