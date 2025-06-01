<?php

namespace Botfire\Models;

class LoginUrl
{
    protected string $url;
    protected ?string $forward_text = null;
    protected ?string $bot_username = null;
    protected ?bool $request_write_access = null;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function forwardText(?string $forward_text): static
    {
        $this->forward_text = $forward_text;
        return $this;
    }

    public function botUsername(?string $bot_username): static
    {
        $this->bot_username = $bot_username;
        return $this;
    }

    public function requestWriteAccess(?bool $request_write_access): static
    {
        $this->request_write_access = $request_write_access;
        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'url' => $this->url,
        ];

        if ($this->forward_text) {
            $data['forward_text'] = $this->forward_text;
        }

        if ($this->bot_username) {
            $data['bot_username'] = $this->bot_username;
        }

        if ($this->request_write_access) {
            $data['request_write_access'] = $this->request_write_access;
        }

        return $data;
    }
}