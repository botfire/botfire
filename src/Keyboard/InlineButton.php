<?php
namespace Botfire\Keyboard;

use Botfire\Models\CopyTextButton;
use Botfire\Models\LoginUrl;
use Botfire\Models\SwitchInlineQueryChosenChat;
use Botfire\Models\WebAppInfo;

class InlineButton
{
    protected array $data = [];

    public static function btnUrl(string $text, string $url): static
    {
        $btn = new static();
        $btn->text($text);
        $btn->url($url);
        return $btn;
    }

    public static function btn(string $text, string $callback_data): static
    {
        $btn = new static();
        $btn->text($text);
        $btn->callbackData($callback_data);
        return $btn;
    }

    public function text(string $text): static
    {
        $this->data['text'] = $text;
        return $this;
    }

    public function url(?string $url): static
    {
        $this->data['url'] = $url;
        return $this;
    }

    public function callbackData(?string $callback_data): static
    {
        $this->data['callback_data'] = $callback_data;
        return $this;
    }

    public function webApp(?WebAppInfo $web_app): static
    {
        $this->data['web_app'] = $web_app;
        return $this;
    }

    public function loginUrl(?LoginUrl $login_url): static
    {
        $this->data['login_url'] = $login_url;
        return $this;
    }

    public function switchInlineQuery(?string $switch_inline_query): static
    {
        $this->data['switch_inline_query'] = $switch_inline_query;
        return $this;
    }

    public function switchInlineQueryCurrentChat(?string $switch_inline_query_current_chat): static
    {
        $this->data['switch_inline_query_current_chat'] = $switch_inline_query_current_chat;
        return $this;
    }

    public function switchInlineQueryChosenChat(?SwitchInlineQueryChosenChat $switch_inline_query_chosen_chat): static
    {
        $this->data['switch_inline_query_chosen_chat'] = $switch_inline_query_chosen_chat;
        return $this;
    }

    public function copyText(?CopyTextButton $copy_text): static
    {
        $this->data['copy_text'] = $copy_text;
        return $this;
    }

    public function callbackGame($callback_game): static
    {
        $this->data['callback_game'] = $callback_game;
        return $this;
    }

    public function pay(?bool $pay): static
    {
        $this->data['pay'] = $pay;
        return $this;
    }

    public function toArray(): array
    {
        $button = [];

        foreach ($this->data as $key => $value) {
            if ($value === null) {
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