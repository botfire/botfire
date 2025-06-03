<?php
namespace Botfire\Models;
use Botfire\TraitMethods\AllowPaidBroadcastTrait;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\CaptionEntitiesTrait;
use Botfire\TraitMethods\CaptionTrait;
use Botfire\TraitMethods\DisableNotificationTrait;
use Botfire\TraitMethods\DurationTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;
use Botfire\TraitMethods\ParseModeTrait;
use Botfire\TraitMethods\PerformerTrait;
use Botfire\TraitMethods\ProtectContentTrait;
use Botfire\TraitMethods\TitleTrait;


class Voice extends Option{

    use BusinessConnectionIdTrait,MessageThreadIdTrait;
    use ParseModeTrait,DurationTrait, PerformerTrait;
    use CaptionTrait, CaptionEntitiesTrait, TitleTrait, DurationTrait;
    use DisableNotificationTrait, ProtectContentTrait,AllowPaidBroadcastTrait;
    
    protected $data = [];


    /**
     * Audio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data
     * @param mixed $voice
     */
    public function __construct($voice){
        $this->data['voice'] = $voice;
    }


}