<?php
namespace Botfire\TraitMethods;

trait ParseModeTrait
{
    
    /**
     * Mode for parsing entities in the document caption. See formatting options for more details.
     * @param string $parse_mode
     * @return static
     */
    public function parseMode(string $parse_mode)
    {
        $this->data['parse_mode'] = $parse_mode;
        return $this;
    }
}
