<?php

namespace Botfire\TraitMethods;

trait PerformerTrait
{
    /**
     * Performer
     * @param string $performer
     * @return static
     */
    public function performer(string $performer)
    {
        $this->data['performer'] = $performer;
        return $this;
    }
}