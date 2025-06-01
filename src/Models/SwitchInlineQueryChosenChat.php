<?php

namespace Botfire\Models;

class SwitchInlineQueryChosenChat
{
    protected ?string $query = null;
    protected ?bool $allow_user_chats = null;
    protected ?bool $allow_bot_chats = null;
    protected ?bool $allow_group_chats = null;
    protected ?bool $allow_channel_chats = null;

    public function query(?string $query): static
    {
        $this->query = $query;
        return $this;
    }

    public function allowUserChats(?bool $allow_user_chats): static
    {
        $this->allow_user_chats = $allow_user_chats;
        return $this;
    }

    public function allowBotChats(?bool $allow_bot_chats): static
    {
        $this->allow_bot_chats = $allow_bot_chats;
        return $this;
    }

    public function allowGroupChats(?bool $allow_group_chats): static
    {
        $this->allow_group_chats = $allow_group_chats;
        return $this;
    }

    public function allowChannelChats(?bool $allow_channel_chats): static
    {
        $this->allow_channel_chats = $allow_channel_chats;
        return $this;
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->query) {
            $data['query'] = $this->query;
        }

        if ($this->allow_user_chats) {
            $data['allow_user_chats'] = $this->allow_user_chats;
        }

        if ($this->allow_bot_chats) {
            $data['allow_bot_chats'] = $this->allow_bot_chats;
        }

        if ($this->allow_group_chats) {
            $data['allow_group_chats'] = $this->allow_group_chats;
        }

        if ($this->allow_channel_chats) {
            $data['allow_channel_chats'] = $this->allow_channel_chats;
        }

        return $data;
    }
}