<?php

namespace Botfire\Responses;

use Botfire\Responses\Models\PhotoCollection;

class PhotoMessageResult extends MessageResult
{

    private array $photos = [];


    public function __construct($result)
    {
        parent::__construct($result);
        $this->photos = $result['photo'];
    }


    /**
     * Get the photo collection from the result.
     * @return PhotoCollection
     */
    public function getPhoto(): PhotoCollection
    {
        return new PhotoCollection($this->photos);
    }
}
