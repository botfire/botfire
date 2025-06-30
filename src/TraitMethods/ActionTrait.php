<?php
namespace Botfire\TraitMethods;

trait ActionTrait
{
    /**
     * Type of action to broadcast.
     * Choose one, depending on what the user is about to receive: 
     * - typing for text messages, upload_photo for photos, record_video or upload_video for videos, record_voice or upload_voice for voice notes, upload_document for general files, choose_sticker for stickers, find_location for location data, record_video_note or upload_video_note for video notes.
     * @param string $action
     */
    public function action(string $action){
        $this->data['action'] = $action;
        return $this;
    }
}