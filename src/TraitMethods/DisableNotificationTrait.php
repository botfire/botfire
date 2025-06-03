<?php
namespace Botfire\TraitMethods;
trait DisableNotificationTrait
{

    /**
     * Sends the message silently. Users will receive a notification with no sound.
     * @param bool $disable_notification
     * @return static
     */
    public function disableNotification(bool $disable_notification)
    {
        $this->data['disable_notification'] = $disable_notification;
        return $this;
    }
}