<?php
namespace Botfire\Models;

use Botfire\TraitMethods\AllowPaidBroadcastTrait;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\CaptionEntitiesTrait;
use Botfire\TraitMethods\CaptionAndParseModeTrait;
use Botfire\TraitMethods\DisableNotificationTrait;
use Botfire\TraitMethods\DurationTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;
use Botfire\TraitMethods\PerformerTrait;
use Botfire\TraitMethods\ProtectContentTrait;
use Botfire\TraitMethods\ThumbnailTrait;
use Botfire\TraitMethods\TitleTrait;

class Audio extends Option
{

    use BusinessConnectionIdTrait,MessageThreadIdTrait;
    use DurationTrait, PerformerTrait;
    use CaptionAndParseModeTrait, CaptionEntitiesTrait, TitleTrait, DurationTrait, PerformerTrait;
    use DisableNotificationTrait, ProtectContentTrait,AllowPaidBroadcastTrait;
    use ThumbnailTrait;
    

    protected $data = [];

    /**
     * Audio file to send. Pass a file_id as String to send an audio file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an audio file from the Internet, or upload a new one using multipart/form-data
     * @param mixed $audio
     */
    public function __construct($audio)
    {
        $this->data['audio'] = $audio;
    }
}