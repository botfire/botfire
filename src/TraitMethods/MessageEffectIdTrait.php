<?php
namespace Botfire\TraitMethods;

trait MessageEffectIdTrait
{
    /**
     * Unique identifier of the message effect to be applied to the message.
     * @param string $message_effect_id
     * @return static
     */
    public function messageEffectId(string $message_effect_id)
    {
        $this->data['message_effect_id'] = $message_effect_id;
        return $this;
    }
}