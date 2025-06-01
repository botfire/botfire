<?php
namespace Botfire\Models;

/**
 * This object represents a Telegram user or bot.
 * @see https://core.telegram.org/bots/api#user
 */

class User
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
     * Unique identifier for this user or bot.
     * This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it.
     * But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     */
    public function getId(): ?int
    {
        return $this->data['id'] ?? null;
    }


    /**
     * True, if this user is a bot
     * @return bool
     */
    public function isBot(): bool
    {
        return $this->data['is_bot'] ?? false;
    }


    /**
     * User's or bot's first name
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->data['first_name'] ?? null;
    }

    /**
     * Optional. User's or bot's last name
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->data['last_name'] ?? null;
    }

    /**
     * Get the full name of the user or bot.
     * Combines first name and last name if available.
     * @return string|null
     */
    public function getFullName(): ?string
    {
        $firstName = $this->getFirstName();
        $lastName = $this->getLastName();

        if ($firstName && $lastName) {
            return $firstName . ' ' . $lastName;
        }

        return $firstName ?? $lastName;
    }


    /**
     * Optional. User's or bot's username
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->data['username'] ?? null;
    }


    /**
     * Optional. IETF language tag of the user's language
     * @return string|null
     */
    public function getLanguageCode(): ?string
    {
        return $this->data['language_code'] ?? null;
    }


    /**
     * Optional. True, if this user is a Telegram Premium user
     * @return bool
     */
    public function isPremium(): bool
    {
        return $this->data['is_premium'] ?? false;
    }


    /**
     * Optional. True, if this user added the bot to the attachment menu
     * @return bool
     */
    public function addedToAttachmentMenu(): bool
    {
        return $this->data['added_to_attachment_menu'] ?? false;
    }


    /**
     * Optional. True, if the bot can be invited to groups.
     * Returned only in getMe.
     * @return bool|null
     */
    public function canJoinGroups(): ?bool
    {
        return $this->data['can_join_groups'] ?? null;
    }

    /**
     * Optional. True, if privacy mode is disabled for the bot.
     * Returned only in getMe.
     * @return bool|null
     */
    public function canReadAllGroupMessages(): ?bool
    {
        return $this->data['can_read_all_group_messages'] ?? null;
    }


    /**
     * Optional. True, if the bot supports inline queries
     * Returned only in getMe.
     * @return bool|null
     */
    public function supportsInlineQueries(): ?bool
    {
        return $this->data['supports_inline_queries'] ?? null;
    }


    /**
     * Optional. True, if the bot can be connected to a Telegram Business account to receive its messages.
     * Returned only in getMe.
     * @return bool|null
     */
    public function canConnectToBusiness(): ?bool
    {
        return $this->data['can_connect_to_business'] ?? null;
    }


    /**
     * Optional. True, if the bot has a main Web App.
     * Returned only in getMe.
     * @return bool|null
     */
    public function hasMainWebApp(): ?bool
    {
        return $this->data['has_main_web_app'] ?? null;
    }

    public function toArray(): array
    {
        return $this->data;
    }


}