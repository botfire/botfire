<?php
namespace Botfire;

class KeyboardButton {
    protected string $text;
    protected ?KeyboardButtonRequestUsers $request_users = null;
    protected ?KeyboardButtonRequestChat $request_chat = null;
    protected bool $request_contact = false;
    protected bool $request_location = false;
    protected bool $request_poll = false;
    protected string $request_poll_type = '';
    protected ?WebAppInfo $web_app = null;

    public function __construct(string $text) {
        $this->text = $text;
    }

    public function requestContact(bool $request_contact): static {
        $this->request_contact = $request_contact;
        return $this;
    }

    public function requestLocation(bool $request_location): static {
        $this->request_location = $request_location;
        return $this;
    }

    public function requestPoll(bool $request_poll, string $type = ''): static {
        if ($type) {
            $this->request_poll_type = $type;
        }
        $this->request_poll = $request_poll;
        return $this;
    }

    public function requestUsers(?KeyboardButtonRequestUsers $request_users): static {
        $this->request_users = $request_users;
        return $this;
    }

    public function requestChat(?KeyboardButtonRequestChat $request_chat): static {
        $this->request_chat = $request_chat;
        return $this;
    }

    public function webApp(?WebAppInfo $web_app): static {
        $this->web_app = $web_app;
        return $this;
    }


    public function toArray(): array {
        $button = [
            'text' => $this->text,
        ];

        if ($this->request_users) {
            $button['request_users'] = $this->request_users->toArray();
        }

        if ($this->request_chat) {
            $button['request_chat'] = $this->request_chat->toArray();
        }

        if ($this->request_contact) {
            $button['request_contact'] = true;
        }

        if ($this->request_location) {
            $button['request_location'] = true;
        }

        if ($this->request_poll) {
            $button['request_poll'] = [
                'type' => $this->request_poll_type
            ];
        }

        if ($this->web_app) {
            $button['web_app'] = $this->web_app->toArray();
        }

        return $button;
    }
}