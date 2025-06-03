<?php
namespace Botfire\TraitMethods;

trait HasSpoilerTrait
{
    /**
     * Pass True if the animation needs to be covered with a spoiler animation
     * @param bool $has_spoiler
     * @return static
     */
    public function hasSpoiler(bool $has_spoiler){
        $this->data['has_spoiler'] = $has_spoiler;
        return $this;
    }
}