<?php
namespace Botfire;

class InlineKeyboardButton
{
    protected string $text;
    protected ?string $url = null;
    protected ?string $callback_data = null;
    protected ?WebAppInfo $web_app = null;
    protected ?LoginUrl $login_url = null;
    protected ?string $switch_inline_query = null;
    protected ?string $switch_inline_query_current_chat = null;
    protected ?SwitchInlineQueryChosenChat $switch_inline_query_chosen_chat = null;
    protected ?CopyTextButton $copy_text = null;
    protected ?CallbackGame $callback_game = null;
    protected ?bool $pay = null;



    public function url(string $text, string $url): static
    {
        $this->text = $text;
        $this->url = $url;
        return $this;
    }

    public function btn(string $text, string $callback_data): static
    {
        $this->text = $text;
        $this->callback_data = $callback_data;
        return $this;
    }

    public function webApp(?WebAppInfo $web_app): static
    {
        $this->web_app = $web_app;
        return $this;
    }

    public function loginUrl(?LoginUrl $login_url): static
    {
        $this->login_url = $login_url;
        return $this;
    }

    public function switchInlineQuery(?string $switch_inline_query): static
    {
        $this->switch_inline_query = $switch_inline_query;
        return $this;
    }

    public function switchInlineQueryCurrentChat(?string $switch_inline_query_current_chat): static
    {
        $this->switch_inline_query_current_chat = $switch_inline_query_current_chat;
        return $this;
    }

    public function switchInlineQueryChosenChat(?SwitchInlineQueryChosenChat $switch_inline_query_chosen_chat): static
    {
        $this->switch_inline_query_chosen_chat = $switch_inline_query_chosen_chat;
        return $this;
    }

    public function copyText(?CopyTextButton $copy_text): static
    {
        $this->copy_text = $copy_text;
        return $this;
    }

    public function callbackGame(?CallbackGame $callback_game): static
    {
        $this->callback_game = $callback_game;
        return $this;
    }

    public function pay(?bool $pay): static
    {
        $this->pay = $pay;
        return $this;
    }

    public function toArray(): array
    {
        $button = [
            'text' => $this->text,
        ];

        if ($this->url) {
            $button['url'] = $this->url;
        }

        if ($this->callback_data) {
            $button['callback_data'] = $this->callback_data;
        }

        if ($this->web_app) {
            $button['web_app'] = $this->web_app->toArray();
        }

        if ($this->login_url) {
            $button['login_url'] = $this->login_url->toArray();
        }

        if ($this->switch_inline_query) {
            $button['switch_inline_query'] = $this->switch_inline_query;
        }

        if ($this->switch_inline_query_current_chat) {
            $button['switch_inline_query_current_chat'] = $this->switch_inline_query_current_chat;
        }

        if ($this->switch_inline_query_chosen_chat) {
            $button['switch_inline_query_chosen_chat'] = $this->switch_inline_query_chosen_chat->toArray();
        }

        if ($this->copy_text) {
            $button['copy_text'] = $this->copy_text->toArray();
        }

        if ($this->callback_game) {
            $button['callback_game'] = $this->callback_game->toArray();
        }

        if ($this->pay) {
            $button['pay'] = $this->pay;
        }

        return $button;
    }
}