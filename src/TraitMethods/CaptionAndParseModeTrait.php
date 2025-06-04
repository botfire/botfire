<?php
namespace Botfire\TraitMethods;

use Botfire\Helper\MarkdownBuilder;
use Botfire\Helper\ParseMode;

trait CaptionAndParseModeTrait
{

    use ParseModeTrait;

    /**
     * Caption 0-1024 characters after entities parsing
     * @param string $caption
     */
    public function caption(string|MarkdownBuilder $caption)
    {
        if ($caption instanceof MarkdownBuilder) {
            $caption = $caption->build();
            $this->parseMode(ParseMode::MarkdownV2);
        }


        $this->data['caption'] = $caption;
        return $this;
    }

}