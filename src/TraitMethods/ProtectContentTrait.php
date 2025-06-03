<?php
namespace Botfire\TraitMethods;

trait ProtectContentTrait
{
    /**
     * Protects the contents of the sent message from forwarding and saving.
     * @param bool $protect_content
     * @return static
     */
    public function protectContent(bool $protect_content)
    {
        $this->data['protect_content'] = $protect_content;
        return $this;
    }
}