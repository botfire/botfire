<?php
namespace Botfire\TraitMethods;

trait WidthTrait
{
    /**
     * Video Or Animation Width
     * @param int $width
     * @return static
     */
    public function width(int $width){
        $this->data['width'] = $width;
        return $this;
    }
}