<?php
namespace Botfire\TraitMethods;

trait ThumbnailTrait
{

    /**
     * Thumbnail of the file sent; can be ignored if the file is not uploaded using multipart/form-data
     * @param mixed $thumbnail
     * @return static
     */
    public function thumbnail($thumbnail)
    {
        $this->data['thumbnail'] = $thumbnail;
        return $this;
    }
}