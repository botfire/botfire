<?php
namespace Botfire\Keyboard;

use Botfire\Models\WebAppInfo;

class ReplyButton {
    protected array $data = [];

    public function __construct(string $text) {
        $this->data['text'] = $text;
    }

    public static function create(string $text): static {
        return new static($text);
    }

    public function requestContact(bool $request_contact): static {
        $this->data['request_contact'] = $request_contact;
        return $this;
    }

    public function requestLocation(bool $request_location): static {
        $this->data['request_location'] = $request_location;
        return $this;
    }

    public function requestPoll(bool $request_poll, string $type = ''): static {
        if ($request_poll) {
            $this->data['request_poll'] = ['type' => $type];
        }
        return $this;
    }

    public function requestUsers(?KeyboardButtonRequestUsers $request_users): static {
        $this->data['request_users'] = $request_users;
        return $this;
    }

    public function requestChat(?KeyboardButtonRequestChat $request_chat): static {
        $this->data['request_chat'] = $request_chat;
        return $this;
    }

    public function webApp(?WebAppInfo $web_app): static {
        $this->data['web_app'] = $web_app;
        return $this;
    }

    public function toArray(): array {
        $button = [];
        foreach ($this->data as $key => $value) {
            if ($value === null || $value === false) {
                continue;
            }
            // Handle objects with toArray method
            if (is_object($value) && method_exists($value, 'toArray')) {
                $button[$key] = $value->toArray();
            } else {
                $button[$key] = $value;
            }
        }
        return $button;
    }
}