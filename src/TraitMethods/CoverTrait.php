<?php
namespace Botfire\TraitMethods;

trait CoverTrait
{
    /**
     * Cover for the video in the message
     * @param mixed $cover
     * @return static
     */
    public function cover($cover){
        $this->data['cover'] = $cover;
        return $this;
    }
}