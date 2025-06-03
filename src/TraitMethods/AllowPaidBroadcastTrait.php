<?php
namespace Botfire\TraitMethods;
trait AllowPaidBroadcastTrait
{
    /**
     * Allows the message to be sent as a paid broadcast.
     * @param bool $allow_paid_broadcast
     * @return static
     */
    public function allowPaidBroadcast(bool $allow_paid_broadcast)
    {
        $this->data['allow_paid_broadcast'] = $allow_paid_broadcast;
        return $this;
    }
}