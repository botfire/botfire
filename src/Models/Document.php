<?php
namespace Botfire\Models;

use Botfire\Helper\MarkdownBuilder;
use Botfire\TraitMethods\AllowPaidBroadcastTrait;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\CaptionEntitiesTrait;
use Botfire\TraitMethods\CaptionAndParseModeTrait;
use Botfire\TraitMethods\DisableNotificationTrait;
use Botfire\TraitMethods\MessageEffectIdTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;
use Botfire\TraitMethods\ProtectContentTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;
use Botfire\TraitMethods\ReplyParametersTrait;
use Botfire\TraitMethods\ThumbnailTrait;
use CURLFile;


class Document extends Option
{

    use BusinessConnectionIdTrait, MessageThreadIdTrait, ThumbnailTrait;
    use CaptionAndParseModeTrait, CaptionEntitiesTrait;
    use DisableNotificationTrait, ProtectContentTrait, AllowPaidBroadcastTrait;
    use MessageEffectIdTrait, ReplyParametersTrait, ReplyMarkupTrait;


    protected $data = [];


    /**
     * 	File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.
     * @param MarkdownBuilder|CURLFile|string $document
     * @return void
     */
    public function __construct(MarkdownBuilder|CURLFile|string $document)
    {
        $this->data['document'] = $document;
    }


    /**
     * 	File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.
     * @param MarkdownBuilder|CURLFile|string $document
     * @return static
     */
    public static function create(MarkdownBuilder|CURLFile|string $document)
    {
        return new static($document);
    }


}