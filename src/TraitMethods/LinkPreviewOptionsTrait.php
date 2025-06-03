<?php
namespace Botfire\TraitMethods;

trait LinkPreviewOptionsTrait
{
    /**
     * Link preview generation options for the message
     * @param mixed $link_preview_options
     * @return static
     */
    public function linkPreviewOptions($link_preview_options)
    {
        $this->data['link_preview_options'] = $link_preview_options;
        return $this;
    }
}