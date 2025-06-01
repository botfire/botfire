<?php

namespace Botfire\Models;

class CopyTextButton
{
    protected string $text;

    public function __construct(string $text)
    {
        $this->setText($text);
    }

    public function setText(string $text): static
    {
        if (strlen($text) < 1 || strlen($text) > 256) {
            throw new \InvalidArgumentException('Text must be between 1 and 256 characters.');
        }

        $this->text = $text;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'text' => $this->text,
        ];
    }
}