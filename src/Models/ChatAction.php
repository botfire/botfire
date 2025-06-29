<?php
namespace Botfire\Models;

use Botfire\TraitMethods\ActionTrait;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;


class ChatAction extends Option{

    use BusinessConnectionIdTrait, MessageThreadIdTrait, ActionTrait;

    protected $data = [];



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
}