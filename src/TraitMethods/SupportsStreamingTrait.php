<?php
namespace Botfire\TraitMethods;

trait SupportsStreamingTrait
{
    /**
     * Pass True if the uploaded video is suitable for streaming
     * @param bool $supportsStreaming
     * @return static
     */
    public function supportsStreaming(bool $supportsStreaming){
        $this->data['supports_streaming'] = $supportsStreaming;
        return $this;
    }
}