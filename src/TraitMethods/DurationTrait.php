<?php

namespace Botfire\TraitMethods;

trait DurationTrait
{
    /**
     * Duration of the audio in seconds
     * @param int $duration
     * @return static
     */
    public function duration(int $duration)
    {
        $this->data['duration'] = $duration;
        return $this;
    }
}