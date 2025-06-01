<?php
namespace Botfire\Models;

class Chat {
    private $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
     * Unique identifier for this chat.
     * @return int|null
     */
    public function getId(): ?int {
        return $this->data['id'] ?? null;
    }

    /**
     * Type of the chat, can be either “private”, “group”, “supergroup” or “channel”.
     * @return string|null
     */
    public function getType(): ?string {
        return $this->data['type'] ?? null;
    }

    /**
     * Optional. Title, for supergroups, channels and group chats.
     * @return string|null
     */
    public function getTitle(): ?string {
        return $this->data['title'] ?? null;
    }

    /**
     * Optional. Username, for private chats, supergroups and channels if available.
     * @return string|null
     */
    public function getUsername(): ?string {
        return $this->data['username'] ?? null;
    }

    /**
     * Optional. First name of the other party in a private chat.
     * @return string|null
     */
    public function getFirstName(): ?string {
        return $this->data['first_name'] ?? null;
    }

    /**
     * Optional. Last name of the other party in a private chat.
     * @return string|null
     */
    public function getLastName(): ?string {
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
     * Optional. True, if the supergroup chat is a forum (has topics enabled).
     * @return bool
     */
    public function isForum(): bool {
        return $this->data['is_forum'] ?? false;
    }

    /**
     * Returns the chat data as an array.
     * @return array
     */
    public function asArray(): array {
        return $this->data;
    }
}