<?php
namespace Botfire\Models;

use Botfire\TraitMethods\AllowPaidBroadcastTrait;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\CaptionEntitiesTrait;
use Botfire\TraitMethods\CaptionAndParseModeTrait;
use Botfire\TraitMethods\DisableNotificationTrait;
use Botfire\TraitMethods\DurationTrait;
use Botfire\TraitMethods\HasSpoilerTrait;
use Botfire\TraitMethods\HeightTrait;
use Botfire\TraitMethods\MessageEffectIdTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;
use Botfire\TraitMethods\ProtectContentTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;
use Botfire\TraitMethods\ReplyParametersTrait;
use Botfire\TraitMethods\ShowCaptionAboveMediaTrait;
use Botfire\TraitMethods\ThumbnailTrait;
use Botfire\TraitMethods\WidthTrait;

class Animation extends Option
{


    use BusinessConnectionIdTrait, MessageThreadIdTrait, ThumbnailTrait;
    use CaptionAndParseModeTrait, CaptionEntitiesTrait;
    use DisableNotificationTrait, ProtectContentTrait, AllowPaidBroadcastTrait;
    use MessageEffectIdTrait, ReplyParametersTrait, ReplyMarkupTrait;
    use DurationTrait, WidthTrait, HeightTrait, ShowCaptionAboveMediaTrait, HasSpoilerTrait;



    protected $data = [];


    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent Message is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future
     * @param mixed $audio
     */
    public function __construct($audio)
    {
        $this->data['animation'] = $audio;
    }

}