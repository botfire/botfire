<?php

namespace Botfire\TraitMethods;

trait TitleTrait
{
    /**
     * Track name
     * @param string $title
     * @return static
     */
    public function title(string $title)
    {
        $this->data['title'] = $title;
        return $this;
    }
}