<?php
namespace Botfire\Models;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\CaptionEntitiesTrait;
use Botfire\TraitMethods\CaptionAndParseModeTrait;
use Botfire\TraitMethods\InlineMessageIdTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;
use Botfire\TraitMethods\ShowCaptionAboveMediaTrait;

class EditCaption extends Option
{


    use BusinessConnectionIdTrait, CaptionAndParseModeTrait, InlineMessageIdTrait;
    use CaptionEntitiesTrait,ShowCaptionAboveMediaTrait, ReplyMarkupTrait;


    protected $data = [];




    /**
     * New caption of the message, 0-1024 characters after entities parsing
     * @param mixed $caption
     */
    public function __construct($caption)
    {
        $this->data['caption'] = $caption;
    }





}