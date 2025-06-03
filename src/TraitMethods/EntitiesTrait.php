<?php
namespace Botfire\TraitMethods;

trait EntitiesTrait
{
    /**
     * A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
     * @param mixed $entities
     * @return static
     */
    public function entities($entities)
    {
        $this->data['entities'] = $entities;
        return $this;
    }
}