<?php
namespace Botfire\Models;

use Botfire\Bot;
use Botfire\TraitMethods\ActionTrait;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;


class ChatAction extends Option{

    use BusinessConnectionIdTrait, MessageThreadIdTrait, ActionTrait;

    protected $data = [];

    const TYPEING = 'typing';
    const UPLOAD_PHOTO = 'upload_photo';
    const RECORD_VIDEO = 'record_video';
    const UPLOAD_VIDEO = 'upload_video';
    const RECORD_VOICE = 'record_voice';
    const UPLOAD_VOICE = 'upload_voice';
    const UPLOAD_DOCUMENT = 'upload_document';
    const CHOOSE_STICKER = 'choose_sticker';
    const FIND_LOCATION = 'find_location';
    const RECORD_VIDEO_NOTE = 'record_video_note';
    const UPLOAD_VIDEO_NOTE = 'upload_video_note';
    


    /**
     * Use this method when you need to tell the user that something is happening on the bot's side.
     * The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
     * Returns True on success.
     * @param string $action
     */
    public function __construct(string $action){
        $this->data['action'] = $action;
    }



    /**
     * Use this method when you need to tell the user that something is happening on the bot's side.
     * The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
     * Returns True on success.
     * @param string $action
     */
    public static function create(string $video): static
    {
        return new static($video);
    }

    
    public function send(){
        return Bot::sendChatAction($this);
    }
}