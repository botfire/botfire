<?php
namespace Botfire\TraitMethods;

trait HeightTrait
{
    /**
     * Video Or Animation height
     * @param int $height
     * @return static
     */
    public function height(int $height){
        $this->data['height'] = $height;
        return $this;
    }
}