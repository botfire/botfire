<?php
namespace Botfire\Models;
use Botfire\TraitMethods\AllowPaidBroadcastTrait;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\CaptionEntitiesTrait;
use Botfire\TraitMethods\CaptionTrait;
use Botfire\TraitMethods\DisableNotificationTrait;
use Botfire\TraitMethods\HasSpoilerTrait;
use Botfire\TraitMethods\MessageEffectIdTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;
use Botfire\TraitMethods\ParseModeTrait;
use Botfire\TraitMethods\ProtectContentTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;
use Botfire\TraitMethods\ReplyParametersTrait;
use Botfire\TraitMethods\ShowCaptionAboveMediaTrait;


class Photo extends Option{


    use BusinessConnectionIdTrait, MessageThreadIdTrait;
    use CaptionTrait, ParseModeTrait, CaptionEntitiesTrait;
    use DisableNotificationTrait, ProtectContentTrait, AllowPaidBroadcastTrait;
    use MessageEffectIdTrait, ReplyParametersTrait, ReplyMarkupTrait;
    use ShowCaptionAboveMediaTrait, HasSpoilerTrait;


    protected $data = [];


    /**
     * Photo to send.
     * Pass a file_id as String to send a photo that exists on the Telegram servers (recommended),
     * pass an HTTP URL as a String for Telegram to get a photo from the Internet, or upload a new photo using multipart/form-data.
     * The photo must be at most 10 MB in size.
     * The photo's width and height must not exceed 10000 in total.
     * Width and height ratio must be at most 20
     * @param mixed $photo
     */
    public function __construct($photo){
        $this->data['photo'] = $photo;
    }


}