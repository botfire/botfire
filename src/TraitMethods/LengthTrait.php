<?php
namespace Botfire\TraitMethods;

trait LengthTrait
{
    /**
     * Video width and height, i.e. diameter of the video message
     * @param int $length
     * @return static
     */
    public function length(int $length)
    {
        $this->data['length'] = $length;
        return $this;
    }
}